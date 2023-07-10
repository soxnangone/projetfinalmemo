<?php

namespace App\Http\Controllers;

use App\Models\Mariage;
use App\Models\Utilisateur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class homecontroller extends Controller
{
    public function index()
    {
        $mariageByAnnee = DB::table('mariages')
            ->select('type_dec', DB::raw('count(*) as total'))
            ->groupBy('type_dec')
            ->get();
        $mariageByUser = Utilisateur::with('mariage')
         ->select('username', DB::raw('count(*) as total'))
            ->groupBy('username')
            ->get();
        $userActive=DB::table('utilisateurs')
            ->select('Statut', DB::raw('count(*) as total'))
            ->groupBy('Statut')
            ->get();
$validation=DB::table('mariages')
    ->where('validation','=',0)->select('validation', DB::raw('count(*) as total'))
    ->groupBy('validation')
    ->get();
        $count = Mariage::query()
            ->with('epouse')
            ->with('epoux')
            ->count('id');
        $count2 = Mariage::query()
            ->with('epouse')
            ->with('epoux')
            ->where('validation', '=', 1)->count('id');
        $count3 = Mariage::query()
            ->with('epouse')
            ->with('epoux')
            ->where('validation', '=', 0)->count('id');
        return view('dashboard', compact('count', 'count2', 'count3', 'mariageByAnnee','mariageByUser','validation','userActive'));
    }

}
