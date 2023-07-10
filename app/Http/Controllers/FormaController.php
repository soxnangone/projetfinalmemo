<?php

namespace App\Http\Controllers;

use App\Models\Forma;
use App\Models\Localite;
use Illuminate\Http\Request;

class FormaController extends Controller
{
    public function liste_forma(){
        $forma = Forma::all();
        $localite = Localite::all();
        return view('listes_formation_sanitaires' , compact('forma','localite'));
    }
}
