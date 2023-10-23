<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Mariage;
use App\Models\Utilisateur;
use http\Message;
use Illuminate\Auth\AuthManager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Yajra\DataTables\DataTables;

class UtilisateurController extends Controller
{

    public function __construct()
    {
        $this->middleware('revalidate');
    }

    public function index(Request $request)
    {
        $data = Utilisateur::query()
            ->get();
        if ($request->ajax()) {
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    if ($row->Statut == 1) {
                        $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Edit" class="edit btn btn-info  btn-sm desactiver" >DESACTIVER</a>';
                    } else {
                        $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Edit" class="edit btn btn-info  btn-sm activer" >ACTIVER</a>';
                    }
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        $title = 'utilisateur';
        return view('utilisateur.register', compact('title'));
    }

    public function edit($id)
    {
        $utilisateur = Utilisateur::find($id);
        $title = 'utilisateur';
        return view('profile.index')->with('utilisateur', $utilisateur,compact('title'));
    }

    //inscription
    public function store()
    {
        $utilisateur = new Utilisateur();

        $utilisateur->nom = strtoupper(request('name'));
        $utilisateur->nin = strtoupper(request('nin'));
        $utilisateur->prenom = strtoupper(request('prenom'));
        $utilisateur->email = strtoupper(request('email'));
        $utilisateur->adresse = strtoupper(request('adresse'));
        $utilisateur->telephone = strtoupper(request('telephone'));
        $utilisateur->username = strtoupper(request('username'));
        $utilisateur->poste = strtoupper(request('poste'));
        $trouv = $utilisateur->save();
        if ($trouv) {
            return redirect()->route('Listes_Utilisateurs.index');
        }
        else return back();
    }
    public function upStat($id)
    {
        $Utilisateur = Utilisateur::query()->find($id);
        $Utilisateur->Statut = !$Utilisateur->Statut;
        $Utilisateur->save();
        return redirect()->route('Listes_Utilisateurs.index');
    }
    //connexion
    public function connexion()
    {

        $user = auth()->attempt([
            'username' => request('username'),
            'password' => request('password'),
        ]);
        if ($user) {
            if (request('password') == "passer") {
                return redirect()->route('dashboard');
            }
        } else {
            return redirect()->route('accueil')->with('error', 'login ou password incorrect');
        }
    }

    //nouveau mdp
    public function update_profile(Request $request)
    {
        Utilisateur::query()
            ->where('id', $request->get('id_user'))
            ->update([
                'nom' => strtoupper(request('nom')),
                'prenom' => strtoupper(request('prenom')),
                'email' => strtoupper(request('email')),
                'adresse' => strtoupper(request('adresse')),
                'telephone' => strtoupper(request('telephone')),
                'username' => strtoupper(request('username')),
            ]);
        auth()->user()->update($request->all());
        return view('dashboard');
    }
    public function update_password(Request $request)
    {
        Utilisateur::query()
            ->where('id', $request->get('id_user'))
            ->update([
                'password' =>bcrypt(request('password')),
            ]);
        auth()->user()->update($request->all());
        return back();
    }

    public function edite($id)
    {
        $utilisateur = Utilisateur::find($id);
        return view('new_login')->with('utilisateur', $utilisateur);

    }

    public function logout()
    {
        Auth::logout();
        Session()->flush();
        Redirect::back();
        return redirect()->route('accueil');
    }
    public function ChearchByNin_user($nin_user)
    {
        $nin = Utilisateur::query()
            ->where('nin', $nin_user)->get();
        return response()->json($nin);
    }

}
