<?php

namespace App\Http\Controllers;

use App\Patient;
use App\Consultation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;


class PatientController extends Controller
{
    public function index(Request $request)
    { 
        $name= Auth::guard('secretaire')->user()->Nom.' '.Auth::guard('secretaire')->user()->Prenom;

        $patients = Patient::all()->toArray();

        return view('Secretaire.patient.index',['name'=>$name,'patients'=>$patients, 'counter'=>0]);
    }

    public function store(Request $request)
    {

        //validation 
        //return response()->json(['erreur'=>'1']);
        $patient = new Patient;

      
        
            $patient->id_civile = $request->input('id_civile');
            $patient->Nom = $request->input('Nom'); 
            $patient->Prenom = $request->input('Prenom');
            $patient->Tel = $request->input('Tel');
            $patient->Email = $request->input('Email');
            $patient->Sexe = $request->input('Sexe');
            $patient->adresse= $request->input('adresse');
            $patient->Ville = $request->input('Ville');
            $patient->DateNaissance= $request->input('DateNaissance');
            $patient->Occupation= $request->input('Occupation');
            $patient->Nationnalite= $request->input('Nationnalite');
            $patient->typeMutuel= $request->input('typeMutuel');
            $patient->ref_mutuel= $request->input('ref_mutuel');

        $patient->save();

        
    }

    public function update(Request $request, $id){

        $patient = Patient::find($id);

      
        
            $patient->id_civile = $request->input('id_civile');
            $patient->Nom = $request->input('Nom'); 
            $patient->Prenom = $request->input('Prenom');
            $patient->Tel = $request->input('Tel');
            $patient->Email = $request->input('Email');
            $patient->Sexe = $request->input('Sexe');
            $patient->adresse= $request->input('adresse');
            $patient->Ville = $request->input('Ville');
            $patient->DateNaissance= $request->input('DateNaissance');
            $patient->Occupation= $request->input('Occupation');
            $patient->Nationnalite= $request->input('Nationnalite');
            $patient->typeMutuel= $request->input('typeMutuel');
            $patient->ref_mutuel= $request->input('ref_mutuel');
  
        $patient->save();


    }

    public function destroy($Deletedid){

        $patient = Patient::find($Deletedid);
        $patient->delete();
    
    }
   

    public function fichepourMedecin($id){

        $patient = Patient::findOrFail($id);
        $user= Auth::guard('medcin')->user();
        $name= $user->Nom.' '.$user->Prenom;
        $age= Carbon::parse( substr($patient->DateNaissance,0,17) )->age;
        return view('Medcin.Parts.FichePatient',['name'=>$name, 'patient'=>$patient, 'age'=>$age]);

    }



    public function DossierMedical_mainForSearch(Request $request){

        $user= Auth::guard('medcin')->user();
        $name= $user->Nom.' '.$user->Prenom;

        $q = filter_var( $request->input('q'), FILTER_SANITIZE_STRING);
        if($q){

            $patients = Patient::where('Nom','LIKE','%'.$q.'%')->orWhere('Prenom','LIKE','%'.$q.'%')->orWhere('id_civile','LIKE','%'.$q.'%')->OrderBy('Nom')->paginate(14);
        return view('Medcin.DossierMedical.searchView',[ 'name'=>$name,'patients'=>$patients,'q'=>$q ]);
            
        }

        $patients = Patient::OrderBy('Nom')->paginate(14);        
        return view('Medcin.DossierMedical.searchView',[ 'name'=>$name,'patients'=>$patients ]);

    }


    public function DossierMedical_GetIt(Request $request, $id){

        $user= Auth::guard('medcin')->user();
        $name= $user->Nom.' '.$user->Prenom;
        $patient = Patient::findOrFail($id);
        $age= Carbon::parse( substr($patient->DateNaissance,0,17) )->age;
        
        $lastCons = Consultation::where('PatientId',$patient->id)->orderBy('Date','Desc')->First();
        $nbrCons = Consultation::select(DB::raw("count(*) as num"))->where('PatientId',$patient->id)->first();
        
        $consultations = Consultation::where('PatientId',$patient->id)->orderBy('Date','Desc')->paginate(7);
        
        return view('Medcin.DossierMedical.Dossier',['name'=>$name,'patient'=>$patient, 'age'=>$age, 'lastCons'=>$lastCons, 'nbrCons'=>$nbrCons,'consultations'=>$consultations ]);

    }

    public function GetFiche(Request $request, $id){

        $user= Auth::guard('secretaire')->user();
        $name= $user->Nom.' '.$user->Prenom;
        $patient = Patient::findOrFail($id);

        $age= Carbon::parse( substr($patient->DateNaissance,0,17) )->age;
        return view('Secretaire.Parts.FichePatient',['name'=>$name, 'patient'=>$patient, 'age'=>$age]);

    }


}