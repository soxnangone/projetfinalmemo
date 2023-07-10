<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Epoux;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class EpouxController extends Controller
{
    public function listes_epoux_valide()
    {
        $title = "Enregistrement epoux";
        $epoux_valide = Epoux::all();

        return view('formulaire/epoux', compact('title', 'epoux_valide'));

    }
    public function ajout()
    {
        $epoux = new Epoux();

        DB::beginTransaction();
        try {
            //epoux
           
                $epoux->nin_epoux =  strtoupper(request('nin_epoux'));
                $epoux->nom_epoux =  strtoupper(request('nom_epoux'));
                $epoux->prenom_epoux =  strtoupper( request('prenom_epoux'));
                $epoux->date_naiss_epoux =  request('date_naiss__epoux');
                $epoux->lieu_naiss_epoux = strtoupper( request('lieu_naiss_epoux'));
                $epoux->domicile_epoux =  strtoupper(request('domicile_epoux'));
                $epoux->profession_epoux =  strtoupper(request('profession_epoux'));
                $epoux->situation_mat_epoux =  strtoupper(request('situation_mat_epoux'));
                $result = $epoux->save();
                $recup_id_epoux = $epoux->id;
                DB::commit();
                if ($result) {
                    return redirect()->route('epoux_valide')->with('success','Declaration Enregistrer et Envoyer à l\'officier pour la validation');
                }
                else{
                    return redirect()->route('epoux_valide')->with('error','Erreur de l\'enregistrement ');
                }
            } catch (\Exception $ex) {
                DB::Rollback();
                throw $ex;
            }
        }
    //index
    public function index(Request $request)
    {
        $data = Epoux::query();
        if ($request->ajax()) {
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                        $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Edit" class="edit btn btn-primary btn-sm editEpoux" ><i class="fa fa-check"></i></a>';
                        return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        $title = 'validation';
        return view('tables.dynamic', compact('title'));
    }

    public function index1(Request $request)
    {

        $data = Epoux::query()
            ->get();
        if ($request->ajax()) {
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
        if (Auth::user()->poste=="OFFICIER") {
                 if ($row->validation == 1) {
                     $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Edit" class="edit btn  btn-sm modifier" ><i class="fa fa-edit"></i></a>';
                     $btn = $btn . '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Edit" class="edit btn  btn-sm printEpoux"  ><i class="fa fa-print"></i></a>';
                 }
                 else {
                 $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Edit" class="edit btn  btn-sm modifier"  ><i class="fa fa-edit "></i></a>';
        }
    }
        else{
            if ($row->validation == 1) {
                $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Edit" class="edit btn  btn-sm editEpoux"  ><i class="fa fa-plus"></i></a>';
                $btn = $btn . '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Edit" class="edit btn  btn-sm printEpoux"  ><i class="fa fa-print"></i></a>';
            }
            else {
                $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Edit" class="edit btn  btn-sm editEpoux"  ><i class="fa fa-plus "></i></a>';
            }
        }
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        $title = 'Enregistrement';
        return view('formulaire.epoux', compact('title'));
    }

    public function store(Request $request)
    {
Epoux::query()
    ->where('id', $request->get('id_epoux'))
    ->update([
        'nin_epoux'=>strtoupper(request('nin_epoux')),
         'nom_epoux'=>strtoupper(request('nom_epoux')),
         'prenom_epoux'=>strtoupper(request('prenom_epoux')),
         'date_naiss_epoux'=>strtoupper(request('date_naiss_epoux')),
         'lieu_naiss_epoux'=>strtoupper(request('lieu_naiss_epoux')),
         'domicile_epoux'=>strtoupper(request('domicile_epoux')),
         'profession_epoux'=>strtoupper(request('profession_epoux')),
         'situation_mat_epoux'=>strtoupper(request('situation_mat_epoux'))
    ]);

        return response()->json(['success' => 'Enregistrement Validé!']);
    }
    public function edit($id)
    {
        $ep = Epoux::query()
            ->findOrFail($id);
        return response()->json($ep);
    }
    public function editEpoux($id)
    {
        $epx = Epoux::query()
            ->findOrFail($id);
        return response()->json($epx);
    }

}
