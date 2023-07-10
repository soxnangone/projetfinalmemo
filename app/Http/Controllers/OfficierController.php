<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Officier;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class OfficierController extends Controller
{
    public function listes_officier_valide()
    {
        $title = "Enregistrement officier";
        $officier_valide = Officier::all();

        return view('formulaire/officier', compact('title', 'officier_valide'));

    }
    public function ajout()
    {
        $officier = new Officier();

        DB::beginTransaction();
        try {
            //officier
                $officier->nom =  strtoupper(request('nom'));
                $officier->prenom =  strtoupper( request('prenom'));
                $result = $officier->save();
                $recup_id_officier = $officier->id;
                DB::commit();
                if ($result) {
                    return redirect()->route('officier_valide')->with('success','Declaration Enregistrer et Envoyer à l\'officier pour la validation');
                }
                else{
                    return redirect()->route('officier_valide')->with('error','Erreur de l\'enregistrement ');
                }
            } catch (\Exception $ex) {
                DB::Rollback();
                throw $ex;
            }
        }
    //index
    public function index(Request $request)
    {
        $data = Officier::query();
        if ($request->ajax()) {
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                        $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Edit" class="edit btn btn-primary btn-sm editOfficier" ><i class="fa fa-check"></i></a>';
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

        $data = Officier::query()
            ->get();
        if ($request->ajax()) {
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
        if (Auth::user()->poste=="OFFICIER") {
                 if ($row->validation == 1) {
                     $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Edit" class="edit btn  btn-sm modifier" ><i class="fa fa-edit"></i></a>';
                     $btn = $btn . '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Edit" class="edit btn  btn-sm printOfficier"  ><i class="fa fa-print"></i></a>';
                 }
                 else {
                 $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Edit" class="edit btn  btn-sm modifier"  ><i class="fa fa-edit "></i></a>';
        }
    }
        else{
            if ($row->validation == 1) {
                $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Edit" class="edit btn  btn-sm editOfficier"  ><i class="fa fa-plus"></i></a>';
                $btn = $btn . '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Edit" class="edit btn  btn-sm printOfficier"  ><i class="fa fa-print"></i></a>';
            }
            else {
                $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Edit" class="edit btn  btn-sm editOfficier"  ><i class="fa fa-plus "></i></a>';
            }
        }
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        $title = 'Enregistrement';
        return view('formulaire.officier', compact('title'));
    }

    public function store(Request $request)
    {
Officier::query()
    ->where('id', $request->get('id_officier'))
    ->update([
         'nom'=>strtoupper(request('nom')),
         'prenom'=>strtoupper(request('prenom')),
       
    ]);

        return response()->json(['success' => 'Enregistrement Validé!']);
    }
    public function edit($id)
    {
        $ep = Officier::query()
            ->findOrFail($id);
        return response()->json($ep);
    }
    public function editOfficier($id)
    {
        $epx = Officier::query()
            ->findOrFail($id);
        return response()->json($epx);
    }

}
