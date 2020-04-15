<?php

namespace App\Http\Controllers;

use App\Medicament;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MedicamentController extends Controller
{
    //

    public function Index(Request $request){

        $name= Auth::guard('secretaire')->user()->Nom.' '.Auth::guard('secretaire')->user()->Prenom;
        $medicaments = Medicament::all()->toArray();
        
        return view('Secretaire.Medicaments.index',['name'=>$name,'medicaments'=>$medicaments,'counter'=>0]);


        
    }

}