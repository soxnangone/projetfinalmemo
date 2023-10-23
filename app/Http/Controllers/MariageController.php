<?php

namespace App\Http\Controllers;
use App\Models\Temoin;
use App\Models\Utilisateur;
use App\Models\Epouse;
use App\Models\Mariage;
use App\Models\Epoux;
use App\Models\Officier;
use Barryvdh\DomPDF\PDF;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use NumberToWords\NumberToWords;
use Yajra\DataTables\DataTables;

class MariageController extends Controller
{

    //liste_declaration
    public function listes_mariage_valide()
    {
        $title = "Enregistrement Mariage";
        $mariage_valide = Mariage::all()->where('validation', '=', 1);
        $epoux = Epoux::all();
        $epouse = Epouse::all();
        $temoin = Temoin::all();
        $officier = Officier::all();
        return view('declarations/mariage', compact('title', 'mariage_valide', 'epoux', "epouse","temoin","officier"));

    }

    public function listes_mariages()
    {
        $title = "Declaration-mariage";
        $mariages = Mariage::all()->where('validation', '=', 0);
        $epoux = Epoux::all();
        $epouse = Epouse::all();
        $officier = Officier::all();
        $temoin = Temoin::all();
        return view('validations.mariage', compact('title', 'mariages', 'epoux', "epouse","officier","temoin"));

    }

    public function ajout()
    {
        $mariage = new Mariage();
        $epoux = new Epoux();
        $epouse = new Epouse();
        $temoin= new Temoin();
        $officier= new Officier();
        $an=Carbon::now();


        DB::beginTransaction();
        try {
            //mariage

            $mariage->num_registre = strtoupper(request('num_registre'));
            $mariage->annee = $an->year;
            $mariage->heurem = strtoupper(request('heurem'));
            $mariage->datem = request('datem');
            $mariage->lieum = strtoupper(request('lieum'));
            $mariage->date_dec =  strtoupper(request('date_dec'));
            $mariage->regime =  strtoupper(request('regime'));
            $mariage->option =  strtoupper(request('option'));
            $mariage->dot =  strtoupper(request('dot'));
            $mariage->validation =0;
            $mariage->id_epouse = $epouse->recup_id_epouse;
            $mariage->id_epoux = $epoux->recup_id_epoux;
            $mariage->id_t1=$temoin->recup_id_temoin1;
            $mariage->id_t2=$temoin->recup_id_temoin2;
            $mariage->id_t3=$temoin->recup_id_temoin3;
            $mariage->id_t4=$temoin->recup_id_temoin4;
            $mariage->id_officier=$officier->recup_id_officier;
            $mariage->id_user=auth()->id();
            $result = $mariage->save();
            DB::commit();
            if ($result) {
                return redirect()->route('mariage_valide')->with('success','Declaration Enregistrer et Envoyer à l\'officier pour la validation');
            }
            else{
                return redirect()->route('mariage_valide')->with('error','Erreur de l\'enregistrement ');
            }
        } catch (\Exception $ex) {
            DB::Rollback();
            throw $ex;
        }
    }
    //index
    public function index(Request $request)
    {
        $data = Mariage::query()
            ->with('epouse')
            ->with('epoux')
            ->with('officier')
            ->with('temoin')
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

    public function index1(Request $request)
    {

        $data = Mariage::query()
            ->with('epouse')
            ->with('epoux')
            ->with('officier')
            ->with('temoin')
            ->get();
        if ($request->ajax()) {
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
        if (Auth::user()->poste=="OFFICIER") {
                 if ($row->validation == 1) {
                     $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Edit" class="edit btn  btn-sm modifier" ><i class="fa fa-edit"></i></a>';
                     $btn = $btn . '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Edit" class="edit btn  btn-sm printMariage"  ><i class="fa fa-print"></i></a>';
                 }
                 else {
                 $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Edit" class="edit btn  btn-sm modifier"  ><i class="fa fa-edit "></i></a>';
                }
        }
        else{
            if ($row->validation == 1) {
                $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Edit" class="edit btn  btn-sm editMariage"  ><i class="fa fa-plus"></i></a>';
                $btn = $btn . '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Edit" class="edit btn  btn-sm printMariage"  ><i class="fa fa-print"></i></a>';
            }
            else {
                $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Edit" class="edit btn  btn-sm editMariage"  ><i class="fa fa-plus "></i></a>';
            }
        }
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        $title = 'declaration';
        $epoux = Epoux::all();
        $epouse = Epouse::all();
        $officier = Officier::all();
        $temoin = Temoin::all();
        return view('declarations.mariage', compact('title','epoux','epouse','officier','temoin'));
    }

    public function store(Request $request)
    {
      
        Mariage::query()
            ->where('id', $request->get('mariage_id'))
            ->update([
                'num_registre' => request('num_registre'),
                'datem' => request('datem'),
                'lieum' => request('lieum'),
                'heurem'=>request('heurem'),
                'regime' => request('regime'),
                'option' => request('option'),
                'dot'=>request('dot'),
                'validation' => 1,
                'id_validant' => auth()->id()
            ]);
        return response()->json(['success' => 'Declaration Validé!']);
    }
    public function edit($id)
    {
        $mariag = Mariage::query()
            ->with('epouse')
            ->with('epoux')
            ->with('officier')
            ->with('temoin')
            ->findOrFail($id);
        return response()->json($mariag);
    }
    public function editnaiss($id)
    {
        $mariags = Mariage::query()
            ->with('epouse')
            ->with('epoux')
            ->with('officier')
            ->with('temoin')
            ->findOrFail($id);
        return response()->json($mariags);
    }

//affichage page en pdf
    public function getPdf($id)
    {
        $data = Mariage::query()
            ->with('epouse')
            ->with('epoux')
            ->with('officier')
            ->with('temoin')
            ->find($id);
        $number = new NumberToWords();
        $num = $number->getNumberTransformer("fr");
        $registre = strtoupper($num->toWords($data->num_registre));

        $data = compact('data', 'registre');
        $pdf = PDF::loadView('volet', $data)->setPaper('a4', 'portrait');
        return $pdf->stream();
    }

    //affichage donnees existant
    public function MariageByNin_epoux($nin_epoux)
    {
        $nin_epoux = Epoux::query()->where('nin_epoux', '=', $nin_epoux)->get();
        return response()->json($nin_epoux);
    }

    public function MariageByNin_epouse($nin_epouse)
    {
        $nin_epouse = Epouse::query()->where('nin_epouse', '=', $nin_epouse)->get();
        return response()->json($nin_epouse);
    }

    public function MariageByNin_user($nin_user)
    {
        $nin_user = Utilisateur::query()->where('nin', '=', $nin_user)->get();
        return response()->json($nin_user);
    }
}
