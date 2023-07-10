<?php

namespace App\Http\Controllers;

use App\Models\Forma;
use App\Models\Naissance;
use Illuminate\Http\Request;
use NumberToWords\NumberToWords;
use Yajra\DataTables\DataTables;

class ImpressionController extends Controller
{
    public function index(Request $request)
    {
        $data = Naissance::query()
            ->with('mere')
            ->with('pere')
            ->with('declarant')
            ->where('validation', '=', 1)->get();
        if ($request->ajax()) {
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Edit" class="edit btn  btn-sm printNaissance" ><i class="fa fa-print"></i></a>';
                    $btn = $btn . '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Edit" class="edit btn  btn-sm editNaissance"  ><i class="fa fa-plus"></i></a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        $formations = Forma::all();
        $title = 'validation';
        return view('tables.index', compact('formations', 'title'));
    }
    public function getPdf($id)
    {
        $data = Naissance::query()
            ->with('mere')
            ->with('pere')
            ->with('declarant')
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
