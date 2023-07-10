<?php

namespace App\Http\Controllers;

use App\Models\Forma;
use App\Models\Localite;
use Illuminate\Http\Request;

class LocaliteController extends Controller
{
    public function liste_localite(){
        $localites = Localite::all();
        return view('Listes.listes_localites',compact('localites'));
    }
}
