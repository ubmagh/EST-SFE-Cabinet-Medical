<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\confrere;
use App\Lettre_au_confrere;
use App\Http\Controllers\Redirect;
use DB;
use PDF;


class LettreAuConfrereController extends Controller
{
    public function index(Request $request){
     
        $name = Auth::guard('medcin')->user()->Nom.' '.Auth::guard('medcin')->user()->Prenom;
        $confrere = confrere::all();
        
                
        return view('Medcin.lettreAuxConf.index', ['name'=>$name, 'confrere'=>$confrere]);
    }


    public function store(Request $request)
    {
      $lettre = new Lettre_au_confrere();
      $medecin = Auth::guard('medcin')->user();

      $lettre->MedcinId = $medecin->id;
      $lettre->Titre = $request->input('objet');
      $lettre->Message = $request->input('message');

      $conf = confrere::where(DB::raw("CONCAT(`Nom`, ' ', `Prenom`)"), 'LIKE', $request->input('confrere'))->first();

      $lettre->ConfrereID = $conf->id;
     
      $lettre->save();

      $lettre_pdf = PDF::loadview('Medcin.lettreAuxConf.lettre', ['confrere'=>$conf, 
      'medecin'=>$medecin, 'lettre'=>$lettre]);
         return $lettre_pdf->download('lettre.pdf');

        

    }
}
