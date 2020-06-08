<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\confrere;
use App\Patient;
use App\Lettre_au_confrere;
use App\Http\Controllers\Redirect;
use DB;
use Illuminate\Support\Facades\Validator;
use PDF;


class LettreAuConfrereController extends Controller
{

    public function index(Request $request){
        $user = Auth::guard('medcin')->user();
        $name = $user->Nom.' '.$user->Prenom;
        $confrere = confrere::OrderBy('Nom')->get();
        
        $modify = $request->input('modify');
        if(isset($modify) && ctype_digit($modify)){
            $modifyletter = Lettre_au_confrere::findOrFail($modify);
            return view('Medcin.lettreAuxConf.index', ['name'=>$name, 'confrere'=>$confrere,'modifyletter'=>$modifyletter]);
        }
        

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

    public function autocomplete_patient(Request $request)
    {
        $data = Patient::select("id_civile as ID_c", DB::raw(" CONCAT(Nom,' ',Prenom) as name ") )
                        ->where("id_civile","LIKE","%{$request->input('query')}%")
                        ->orWhere("Prenom","LIKE","%{$request->input('query')}%")
                        ->orWhere("Nom","LIKE","%{$request->input('query')}%")
                        ->get();
        return response()->json($data);
    }


    public function store(Request $request){


        if($request->input('modify')){ // modify state
            $rules= [
                'modify'    =>  'required|string|exists:lettre_au_confreres,id',
                'confrere'  => 'required|string|exists:confreres,id',
                'id_civile' =>  'nullable|string|exists:patients,id_civile',
                'objet' =>  'required|string|max:200',
                'message'  =>  'required|string',
            ];

            $messages = [
                'modify.required'    =>  'Données invalides !',
                'modify.string'    =>  'Données invalides !',
                'modify.exists'    =>  'Données invalides !',
                'confrere.required' =>  "choisissez un confrère",
                'confrere.string' =>  "Données invalides !",
                'confrere.exists' =>  "Choix invalide !",
                'id_civile.string' =>  "Données invalides !",
                'id_civile.exists' =>  " patient introuvable !",
                'objet.required' =>  " Saisissez un titre pour le message",
                'objet.string' =>  "Données invalides !",
                'message.string' =>  "Données invalides !",
                'message.required' =>  " Un message est necessaire!",
            ];

        }else{
            $rules= [
                'confrere'  => 'required|string|exists:confreres,id',
                'id_civile' =>  'nullable|string|exists:patients,id_civile',
                'objet' =>  'required|string|max:200',
                'message'  =>  'required|string',
            ];
            $messages = [
                'confrere.required' =>  "choisissez un confrère",
                'confrere.string' =>  "Données invalides !",
                'confrere.exists' =>  "Choix invalide !",
                'id_civile.string' =>  "Données invalides !",
                'id_civile.exists' =>  " patient introuvable !",
                'objet.required' =>  " Saisissez un titre pour le message",
                'objet.string' =>  "Données invalides !",
                'message.string' =>  "Données invalides !",
                'message.required' =>  " Un message est necessaire!",
            ];
        }


        $validator = Validator::make($request->all(),$rules,$messages);

    if ($validator->fails()) {
        return redirect()->back()->withErrors($validator);
    }

        if($request->input('modify')){

            $lettre = Lettre_au_confrere::findOrFail($request->input('modify'));

            
        }else{
    
            $lettre = new Lettre_au_confrere();
            $medecin = Auth::guard('medcin')->user();
            $lettre->MedcinId = $medecin->id;

        }

       

        $idCivile =$request->input('id_civile');

        if($idCivile){
       
            $patient = Patient::where('id_civile', $idCivile)->first() ;
            $lettre->PatientId = $patient->id;

        }else{
            $lettre->PatientId = null;

        }


        $lettre->Titre = $request->input('objet');
        $lettre->Message = $request->input('message');
        $lettre->ConfrereID = $request->input('confrere');


        if($request->input('modify')){

            $res = $lettre->update();
        if($res)
            return redirect('LettreAuConfrere')->with(['status'=> 'goodM', 'letterId'=>$lettre->id ,'modifyletter'=>'sqdsq' ]);

            #modifyletter // set this variable for the front

            return redirect('LettreAuConfrere')->with(['status'=> 'ErrM','modifyletter'=>'sqdf'  ]);
        }


     
        $res = $lettre->save();


        if($res)
            return redirect('LettreAuConfrere')->with(['status'=> 'good', 'letterId'=>$lettre->id  ]);
        return redirect('LettreAuConfrere')->with('status', 'err');

      
    }

    public function destroy($Deletedid){

        $lettre = Lettre_au_confrere::findOrFail($Deletedid);
        $lettre->delete();
    
    }

    public function printLetter($id){

        $lettre = Lettre_au_confrere::findOrFail($id);
        $conf = $lettre->confrere;
        $medecin = $lettre->medcin;
        $lettre_pdf = PDF::loadview('Medcin.lettreAuxConf.lettre', ['confrere'=>$conf, 'medecin'=>$medecin, 'lettre'=>$lettre]);
         return $lettre_pdf->stream('lettre.pdf');

    }

}
