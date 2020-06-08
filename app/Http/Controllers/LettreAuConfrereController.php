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
        $user = Auth::guard('medcin')->user();
        $name = $user->Nom.' '.$user->Prenom;
        $confrere = confrere::OrderBy('Nom')->get();
        
                
        return view('Medcin.lettreAuxConf.index', ['name'=>$name, 'confrere'=>$confrere]);
    }

    public function GetListe(Request $request){
        $user = Auth::guard('medcin')->user();
        $name = $user->Nom.' '.$user->Prenom;
        DB::statement(DB::raw('SET @i = 0'));
        $Lettres = Lettre_au_confrere::select(DB::raw("  @i := @i + 1 AS num, lettre_au_confreres.id as lettreID, lettre_au_confreres.*, confreres.*, concat(patients.Nom,' ',patients.Prenom) as Pnom "))
                                        ->leftJoin('confreres','ConfrereID','confreres.id')
                                        ->leftJoin('patients','PatientId','patients.id')
                                        ->where( 'MedcinId', $user->id)
                                        ->OrderBy('date','DESC')->paginate(13);
        // return $Lettres;
        return view( 'Medcin.lettreAuxConf.list', ['name'=> $name,'Lettres'=>$Lettres]);
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
