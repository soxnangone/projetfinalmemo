<?php

namespace App\Http\Controllers;
use App\Models\Temoin;
use App\Models\Utilisateur;
use Carbon\Carbon;
use App\Models\Declarant;
use App\Models\Forma;
use App\Models\Mere;
use App\Models\Naissance;
use App\Models\Pere;
use Barryvdh\DomPDF\PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use NumberToWords\NumberToWords;
use Yajra\DataTables\DataTables;

class NaissanceController extends Controller
{

    //liste_declaration
    public function listes_naissances_valide()
    {
        $title = "Declaration-naissance";
        $naissance_valide = Naissance::all()->where('validation', '=', 1);
        $declarant = Declarant::all();
        $formations = Forma::all();
        $pere = Pere::all();
        $mere = Mere::all();
        return view('declarations/naissance', compact('title', 'naissance_valide', 'declarant', 'pere', "mere", "formations"));

    }

    /*public function listes_naissances()
    {
        $title = "Declaration-naissance";
        $naissances = Naissance::all()->where('validation', '=', 0);
        $declarant = Declarant::all();
        $formations = Forma::all();
        $pere = Pere::all();
        $mere = Mere::all();
        return view('validations.naissance', compact('title', 'naissances', 'declarant', 'pere', "mere", "formations"));

    }*/

    public function ajout()
    {
        $pere = new Pere();
        $naissance = new Naissance();

        $mere = new Mere();
        $declarant = new Declarant();
        $temoin= new Temoin();
$an=Carbon::now();

        DB::beginTransaction();
        try {
            //pere
            if (!request('id_pere')) {
                $pere->nin_pere =  strtoupper(request('nin_pere'));
                $pere->nom_pere =  strtoupper(request('nom_pere'));
                $pere->prenom_pere =  strtoupper( request('prenom_pere'));
                $pere->date_naissp =  request('datenaissance_pere');
                $pere->lieu_naissp = strtoupper( request('lieu_naissance_pere'));
                $pere->domicile_pere =  strtoupper(request('domicile_pere'));
                $pere->profession_pere =  strtoupper(request('profession_pere'));
                $pere->save();
                $recup_id_pere = $pere->id;
            } else {
                $recup_id_pere = request('id_pere');
            }

            //mere
            if (!request('id_mere')) {
                $mere->nin_mere =  strtoupper(request('nin_mere'));
                $mere->nom_mere =  strtoupper(request('nom_mere'));
                $mere->prenom_mere =  strtoupper(request('prenom_mere'));
                $mere->date_naissm = request('datenaissance_mere');
                $mere->lieu_naissm =  strtoupper(request('lieu_naissance_mere'));
                $mere->domicile_mere =  strtoupper(request('domicile_mere'));
                $mere->profession_mere = strtoupper( request('profession_mere'));
                $mere->save();
                $recup_id_mere = $mere->id;
            } else {
                $recup_id_mere = request('id_mere');
            }
            //declarant
            if (!request('id_declarant')) {
                $declarant->nin_declarant =strtoupper(request('nin_declarant')) ;
                $declarant->nom_declarant = strtoupper(request('nom_declarant'));
                $declarant->prenom_declarant = strtoupper(request('prenom_declarant'));
                $declarant->date_naissd =request('datenaissance_declarant') ;
                $declarant->lieu_naissd = strtoupper(request('lieu_naissance_declarant'));
                $declarant->domicile_declarant = strtoupper(request('domicile_declarant'));
                $declarant->profession_declarant = strtoupper(request('profession_declarant'));
                $declarant->save();
                $recup_id_declarant = $declarant->id;
            } else {
                $recup_id_declarant = request('id_declarant');
            }
            //temoin1
            if (!request('id_t1')) {
                $temoin->nin =strtoupper(request('nin_t1')) ;
                $temoin->nom = strtoupper(request('nom_t1'));
                $temoin->prenom = strtoupper(request('prenom_t1'));
                $temoin->date_naissance=request('datenaissance_t1') ;
                $temoin->lieu_naissance = strtoupper(request('lieu_naissance_t1'));
                $temoin->domicile = strtoupper(request('domicile_t1'));
                $temoin->profession = strtoupper(request('profession_t1'));
                $temoin->save();
                $recup_id_temoin1 = $temoin->id;
            } else {
                $recup_id_temoin1 = request('id_t1');
            }
            //temoin2
            if (!request('id_t2')) {
                $temoin->nin =strtoupper(request('nin_t2')) ;
                $temoin->nom = strtoupper(request('nom_t2'));
                $temoin->prenom = strtoupper(request('prenom_t2'));
                $temoin->date_naissance =request('datenaissance_t2') ;
                $temoin->lieu_naissance = strtoupper(request('lieu_naissance_t2'));
                $temoin->domicile = strtoupper(request('domicile_t2'));
                $temoin->profession = strtoupper(request('profession_t2'));
                $temoin->save();
                $recup_id_temoin2 = $temoin->id;
            } else {
                $recup_id_temoin2 = request('id_t2');
            }
            //enfant

            $naissance->num_registre = strtoupper(request('num_registre'));
            $naissance->annee = $an->year;
            $naissance->nom_enfant = strtoupper(request('nom_enfant'));
            $naissance->prenom_enfant = strtoupper(request('prenom_enfant'));
            $naissance->sexe = strtoupper(request('sexe'));
            $naissance->heure_naiss = strtoupper(request('heure_naissance'));
            $naissance->date_naiss = request('date_naissance');
            $naissance->lieu_naiss = strtoupper(request('lieu_naissance'));
            $naissance->codeforme = strtoupper(request('formation_sanitaire'));
            $naissance->type_dec =  strtoupper(request('type_declaration'));
            $naissance->date_jugement=request('date_jugement');
            $naissance->num_jugement=request('num_jugement');
            $naissance->nom_tribunal=strtoupper(request('nom_tribunal'));
            $naissance->mention=strtoupper(request('mention'));
            $naissance->id_mere = $recup_id_mere;
            $naissance->id_declarant = $recup_id_declarant;
            $naissance->id_pere = $recup_id_pere;
            $naissance->id_temoins1=$recup_id_temoin1;
            $naissance->id_temoins2=$recup_id_temoin2;
            $naissance->id_user=auth()->id();
            $result = $naissance->save();
            DB::commit();
            if ($result) {
                return redirect()->route('naissance_valide')->with('success','Declaration Enregistrer et Envoyer à l\'officier pour la validation');
            }
            else{
                return redirect()->route('naissance_valide')->with('error','Erreur de l\'enregistrement ');
            }
        } catch (\Exception $ex) {
            DB::Rollback();
            throw $ex;
        }
    }
    //index
    public function index(Request $request)
    {
        $data = Naissance::query()
            ->with('mere')
            ->with('pere')
            ->with('declarant')
            ->where('validation', '=', 0)->get();
        if ($request->ajax()) {
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                        $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Edit" class="edit btn btn-primary btn-sm editNaissance" ><i class="fa fa-check"></i></a>';
                        return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        $formations = Forma::all();
        $title = 'validation';
        return view('tables.dynamic', compact('formations', 'title'));
    }

    public function index1(Request $request)
    {

        $data = Naissance::query()
            ->with('mere')
            ->with('pere')
            ->with('declarant')
            ->get();
        if ($request->ajax()) {
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
        if (Auth::user()->poste=="OFFICIER") {
                 if ($row->validation == 1) {
                     $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Edit" class="edit btn  btn-sm modifier" ><i class="fa fa-edit"></i></a>';
                     $btn = $btn . '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Edit" class="edit btn  btn-sm printNaissance"  ><i class="fa fa-print"></i></a>';
                 }
                 else {
                 $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Edit" class="edit btn  btn-sm modifier"  ><i class="fa fa-edit "></i></a>';
        }
    }
        else{
            if ($row->validation == 1) {
                $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Edit" class="edit btn  btn-sm editNaissance"  ><i class="fa fa-plus"></i></a>';
                $btn = $btn . '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Edit" class="edit btn  btn-sm printNaissance"  ><i class="fa fa-print"></i></a>';
            }
            else {
                $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Edit" class="edit btn  btn-sm editNaissance"  ><i class="fa fa-plus "></i></a>';
            }
        }
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        $formations = Forma::all();
        $title = 'declaration';
        return view('declarations.naissance', compact('formations', 'title'));
    }

    public function store(Request $request)
    {
Pere::query()
    ->where('id', $request->get('id_pere'))
    ->update([
        'nin_pere'=>strtoupper(request('nin_pere')),
         'nom_pere'=>strtoupper(request('nom_pere')),
         'prenom_pere'=>strtoupper(request('prenom_pere')),
         'date_naissp'=>strtoupper(request('datenaissance_pere')),
         'lieu_naissp'=>strtoupper(request('lieu_naissance_pere')),
         'domicile_pere'=>strtoupper(request('domicile_pere')),
         'profession_pere'=>strtoupper(request('profession_pere'))
    ]);

        Mere::query()
            ->where('id', $request->get('id_mere'))
            ->update([
                'nin_mere'=>strtoupper(request('nin_mere')),
                'nom_mere'=>strtoupper(request('nom_mere')),
                'prenom_mere'=>strtoupper(request('prenom_mere')),
                'date_naissm'=>request('datenaissance_mere'),
                'lieu_naissm'=>strtoupper(request('lieu_naissance_mere')),
                'domicile_mere'=>strtoupper(request('domicile_mere')),
                'profession_mere'=>strtoupper(request('profession_mere'))

            ]);
        Declarant::query()
            ->where('id', $request->get('id_declarant'))
            ->update([
                'nin_declarant'=>strtoupper(request('nin_declarant')),
                'nom_declarant'=>strtoupper(request('nom_declarant')),
                'prenom_declarant'=>strtoupper(request('prenom_declarant')),
                'date_naissd'=>request('datenaissance_declarant'),
                'lieu_naissd'=>strtoupper(request('lieu_naissance_declarant')),
                'domicile_declarant'=>strtoupper(request('domicile_declarant')),
                'profession_declarant'=>strtoupper(request('profession_declarant'))

            ]);
        Naissance::query()
            ->where('id', $request->get('naissance_id'))
            ->update([
                'annee' => request('annee'),
                'num_registre' => request('num_registre'),
                'nom_enfant' => request('nom_enfant'),
                'prenom_enfant' => request('prenom_enfant'),
                'date_naiss' => request('date_naissance'),
                'lieu_naiss' => request('lieu_naissance'),
                'sexe'=>request('sexe'),
                'type_dec'=>request('type_declaration'),
                'validation' => 1,
                'id_validant' => auth()->id()
            ]);
        return response()->json(['success' => 'Declaration Validé!']);
    }
    public function edit($id)
    {
        $naissan = Naissance::query()
            ->with('mere')
            ->with('pere')
            ->with('declarant')
            ->findOrFail($id);
        return response()->json($naissan);
    }
    public function editnaiss($id)
    {
        $naissanc = Naissance::query()
            ->with('mere')
            ->with('pere')
            ->with('declarant')
            ->findOrFail($id);
        return response()->json($naissanc);
    }

//affichage page en pdf
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
        $pdf = \PDF::loadView('volet', $data)->setPaper('a4', 'portrait');
        return $pdf->stream();
    }

    //affichage donnees existant
    public function NaissanceByNin_pere($nin_pere)
    {
        $nin_pere = Pere::query()->where('nin_pere', '=', $nin_pere)->get();
        return response()->json($nin_pere);
    }

    public function NaissanceByNin_mere($nin_mere)
    {
        $nin_mere = Mere::query()->where('nin_mere', '=', $nin_mere)->get();
        return response()->json($nin_mere);
    }

    public function NaissanceByNin_declarant($nin_declarant)
    {
        $nin_declarant = Declarant::query()->where('nin_declarant', '=', $nin_declarant)->get();
        return response()->json($nin_declarant);
    }
    public function NaissanceByNin_user($nin_user)
    {
        $nin_user = Utilisateur::query()->where('nin', '=', $nin_user)->get();
        return response()->json($nin_user);
    }
}
