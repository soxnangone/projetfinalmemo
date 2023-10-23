<?php

namespace App\Http\Controllers;

use App\Models\Epoux;
use App\Models\Epouse;
use App\Models\Officier;
use App\Models\Temoin;
use App\Models\Mariage;
use Illuminate\Http\Request;
use NumberToWords\NumberToWords;
use Yajra\DataTables\DataTables;

class ImpressionController extends Controller
{
    public function index(Request $request)
    {
        $data = Mariage::query()
            ->with('epouse')
            ->with('epoux')
            ->with('temoin')
            ->with('officier')
            ->where('validation', '=', 0)->get();
        if ($request->ajax()) {
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                        $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Edit" class="edit btn btn-primary btn-sm editMariage" ><i class="fa fa-check"></i></a>';
                        return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        $title = 'validation';
        $epoux = Epoux::all();
        $epouse = Epouse::all();
        $officier = Officier::all();
        $temoin = Temoin::all();
        return view('tables.dynamic', compact('title','epoux','epouse','officier','temoin'));
    }

    public function getPdf($id)
    {
        $data = Mariage::query()
            ->with('epoux')
            ->with('epouse')
            ->with('temoin')
            ->with('officier')
            ->find($id);
        $number = new NumberToWords();
        $num = $number->getNumberTransformer("fr");
        $annee = strtoupper($num->toWords($data->annee));
        $registre = strtoupper($num->toWords($data->num_registre));

        $data = compact('data', 'annee', 'registre');
        $pdf = \PDF::loadView('impression', $data)->setPaper('a4', 'portrait');
        return $pdf->stream();
    }
}
