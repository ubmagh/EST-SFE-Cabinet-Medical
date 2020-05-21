<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ConfrereController extends Controller
{
    //

    public function Secretaire_gestion_view(Request $request){
        $user = Auth::guard('secretaire')->user();
        return view('Secretaire.Confreres.index',['name'=>$user->Nom.' '.$user->Prenom]);
    }

}