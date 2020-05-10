<?php

namespace App\Http\Controllers;

use App\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

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
   
}