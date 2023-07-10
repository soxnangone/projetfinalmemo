<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Temoin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class TemoinController extends Controller
{
    public function listes_temoin_valide()
    {
        $title = "Enregistrement temoin";
        $temoin_valide = Temoin::all();

        return view('formulaire/temoin', compact('title', 'temoin_valide'));

    }
    public function ajout()
    {
        $temoin = new Temoin();

        DB::beginTransaction();
        try {
            //temoin
           
                $temoin->nin =  strtoupper(request('nin'));
                $temoin->nom =  strtoupper(request('nom'));
                $temoin->prenom =  strtoupper( request('prenom'));
                $temoin->date_naissance =  request('date_naissance');
                $temoin->lieu_naissance = strtoupper( request('lieu_naissance'));
                $temoin->domicile =  strtoupper(request('domicile'));
                $temoin->profession =  strtoupper(request('profession'));
                $result = $temoin->save();
                $recup_id_temoin = $temoin->id;
                DB::commit();
                if ($result) {
                    return redirect()->route('temoin_valide')->with('success','Declaration Enregistrer et Envoyer à l\'officier pour la validation');
                }
                else{
                    return redirect()->route('temoin_valide')->with('error','Erreur de l\'enregistrement ');
                }
            } catch (\Exception $ex) {
                DB::Rollback();
                throw $ex;
            }
        }
    //index
    public function index(Request $request)
    {
        $data = Temoin::query();
        if ($request->ajax()) {
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                        $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Edit" class="edit btn btn-primary btn-sm editTemoin" ><i class="fa fa-check"></i></a>';
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

        $data = Temoin::query()
            ->get();
        if ($request->ajax()) {
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
        if (Auth::user()->poste=="OFFICIER") {
                 if ($row->validation == 1) {
                     $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Edit" class="edit btn  btn-sm modifier" ><i class="fa fa-edit"></i></a>';
                     $btn = $btn . '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Edit" class="edit btn  btn-sm printTemoin"  ><i class="fa fa-print"></i></a>';
                 }
                 else {
                 $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Edit" class="edit btn  btn-sm modifier"  ><i class="fa fa-edit "></i></a>';
        }
    }
        else{
            if ($row->validation == 1) {
                $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Edit" class="edit btn  btn-sm editTemoin"  ><i class="fa fa-plus"></i></a>';
                $btn = $btn . '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Edit" class="edit btn  btn-sm printTemoin"  ><i class="fa fa-print"></i></a>';
            }
            else {
                $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Edit" class="edit btn  btn-sm editTemoin"  ><i class="fa fa-plus "></i></a>';
            }
        }
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        $title = 'Enregistrement';
        return view('formulaire.temoin', compact('title'));
    }

    public function store(Request $request)
    {
Temoin::query()
    ->where('id', $request->get('id_officier'))
    ->update([
        'nin'=>strtoupper(request('nin')),
         'nom'=>strtoupper(request('nom')),
         'prenom'=>strtoupper(request('prenom')),
         'date_naissance'=>strtoupper(request('date_naissance')),
         'lieu_naissance'=>strtoupper(request('lieu_naissance')),
         'domicile'=>strtoupper(request('domicile')),
         'profession'=>strtoupper(request('profession')),
    ]);

        return response()->json(['success' => 'Enregistrement Validé!']);
    }
    public function edit($id)
    {
        $ep = Temoin::query()
            ->findOrFail($id);
        return response()->json($ep);
    }
    public function editTemoin($id)
    {
        $epx = Temoin::query()
            ->findOrFail($id);
        return response()->json($epx);
    }

}
