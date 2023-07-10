<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Epouse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class EpouseController extends Controller
{
    public function listes_epouse_valide()
    {
        $title = "Enregistrement epouse";
        $epouse_valide = Epouse::all();

        return view('formulaire/epouse', compact('title', 'epouse_valide'));

    }
    public function ajout()
    {
        $epouse = new Epouse();

        DB::beginTransaction();
        try {
            //epouse
           
                $epouse->nin_epouse =  strtoupper(request('nin_epouse'));
                $epouse->nom_epouse =  strtoupper(request('nom_epouse'));
                $epouse->prenom_epouse =  strtoupper( request('prenom_epouse'));
                $epouse->date_naiss_epouse =  request('date_naiss_epouse');
                $epouse->lieu_naiss_epouse = strtoupper( request('lieu_naiss_epouse'));
                $epouse->domicile_epouse =  strtoupper(request('domicile_epouse'));
                $epouse->profession_epouse =  strtoupper(request('profession_epouse'));
                $epouse->situation_mat_epouse =  strtoupper(request('situation_mat_epouse'));

                $result = $epouse->save();
                $recup_id_epouse = $epouse->id;
                DB::commit();
                if ($result) {
                    return redirect()->route('epouse_valide')->with('success','Declaration Enregistrer et Envoyer à l\'officier pour la validation');
                }
                else{
                    return redirect()->route('epouse_valide')->with('error','Erreur de l\'enregistrement ');
                }
            } catch (\Exception $ex) {
                DB::Rollback();
                throw $ex;
            }
        }
    //index
    public function index(Request $request)
    {
        $data = Epouse::query();
        if ($request->ajax()) {
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                        $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Edit" class="edit btn btn-primary btn-sm editEpouse" ><i class="fa fa-check"></i></a>';
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

        $data = Epouse::query()
            ->get();
        if ($request->ajax()) {
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
        if (Auth::user()->poste=="OFFICIER") {
                 if ($row->validation == 1) {
                     $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Edit" class="edit btn  btn-sm modifier" ><i class="fa fa-edit"></i></a>';
                     $btn = $btn . '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Edit" class="edit btn  btn-sm printEpouse"  ><i class="fa fa-print"></i></a>';
                 }
                 else {
                 $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Edit" class="edit btn  btn-sm modifier"  ><i class="fa fa-edit "></i></a>';
        }
    }
        else{
            if ($row->validation == 1) {
                $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Edit" class="edit btn  btn-sm editEpouse"  ><i class="fa fa-plus"></i></a>';
                $btn = $btn . '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Edit" class="edit btn  btn-sm printEpouse"  ><i class="fa fa-print"></i></a>';
            }
            else {
                $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Edit" class="edit btn  btn-sm editEpouse"  ><i class="fa fa-plus "></i></a>';
            }
        }
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        $title = 'Enregistrement';
        return view('formulaire.epouse', compact('title'));
    }

    public function store(Request $request)
    {
Epouse::query()
    ->where('id', $request->get('id_epouse'))
    ->update([
        'nin_epouse'=>strtoupper(request('nin_epouse')),
         'nom_epouse'=>strtoupper(request('nom_epouse')),
         'prenom_epouse'=>strtoupper(request('prenom_epouse')),
         'date_naiss_epouse'=>strtoupper(request('date_naiss_epouse')),
         'lieu_naiss_epouse'=>strtoupper(request('lieu_naiss_epouse')),
         'domicile_epouse'=>strtoupper(request('domicile_epouse')),
         'profession_epouse'=>strtoupper(request('profession_epouse')),
         'situation_mat_epouse'=>strtoupper(request('situation_mat_epouse'))
    ]);

        return response()->json(['success' => 'Enregistrement Validé!']);
    }
    public function edit($id)
    {
        $ep = Epouse::query()
            ->findOrFail($id);
        return response()->json($ep);
    }
    public function editEpouse($id)
    {
        $epx = Epouse::query()
            ->findOrFail($id);
        return response()->json($epx);
    }

}
