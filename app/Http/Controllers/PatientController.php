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

        DB::statement(DB::raw('SET @i = 0'));
        
        $q = filter_var( $request->input('q'), FILTER_SANITIZE_STRING);
        if( $q ){
            $patients = Patient::select(DB::raw("  @i := @i + 1 AS num, patients.* "))
                                ->where('Nom','LIKE','%'.$q.'%')
                                ->orWhere('Prenom','LIKE','%'.$q.'%')
                                ->orWhere('id_civile','LIKE','%'.$q.'%')
                                ->orWhere('Tel','LIKE','%'.$q.'%')
                                ->orWhere('Email','LIKE','%'.$q.'%')
                                ->orWhere('ref_mutuel','LIKE','%'.$q.'%')
                                ->OrderBy('Nom')->paginate(10);
                            
            return view('Secretaire.patient.index',['name'=>$name,'patients'=>$patients, 'q'=>$q, 'counter'=>$current]);
        }else
        $patients = Patient::select(DB::raw("  @i := @i + 1 AS num, patients.* "))->OrderBy('Nom')->paginate(10);
        $current = $request->input('page') ? $request->input('page') : 1 ;
        return view('Secretaire.patient.index',['name'=>$name,'patients'=>$patients, 'q'=>$q, 'counter'=>$current]);
    }

    public function store(Request $request)
    {

        $this->validate(
            $request,
            [
                "Nom"   =>  "required|string|max:30",
                "Prenom"   =>  "required|string|max:30",
                "id_civile"   =>  "required|string|max:30|min:5|unique:patients,id_civile",
                "Sexe"  =>  [ 'required', 'string', Rule::In(['homme','femme'])],

                "DateNaissance" => "nullable|string|date|date_format:Y-m-d|before:today",
                "Email" => "nullable|string|email|max:90",
                "Tel" => "nullable|string|max:14|min:9|regex:/^[0-9+\- ]*$/i",
                "adresse" => "nullable|string|max:50",
                "Ville" => "nullable|string|max:40",
                "Occupation" => "nullable|string|max:20",
                "Nationnalite" => "nullable|string|max:60",
                "typeMutuel" => [ "nullable", "string", Rule::in(["CNSS","CNOPS","RAMED","FAR"])],
                "ref_mutuel"    => "nullable|required_with:typeMutuel|string|max:255"
            ],
            [
                "Nom.required"  =>  " Saisissez le Nom du Patient ",
                "Nom.string"  =>  " Saisie invalide ",
                "Nom.max"  =>  " 30 caractères au Max ",
                "Prenom.required"  =>  " Saisissez le Prenom du Patient ",
                "Prenom.string"  =>  " Saisie invalide ",
                "Prenom.max"  =>  " 30 caractères au Max ",
                "id_civile.required"  =>  " Saisissez l'identifiant du Patient ",
                "id_civile.string"  => " Saisie invalide ",
                "id_civile.min"  => " identifiant invalide ",
                "id_civile.max"  => " Identifiant Trop long",
                "id_civile.unique"  => " Identifiant invalide, déja enregistré !",
                "Sexe.required"  => " Choisissez le Sexe du Patient",
                "Sexe.string"  => " Choix invalide ",
                "Sexe.in"  => " Choix invalide ",
                "DateNaissance.string"  =>  " Saisie invalide ",
                "DateNaissance.date_format"  =>  " Format invalide ",
                "DateNaissance.before"  =>  " Date invalide ",
                "DateNaissance.date"  =>  " une date est expecté ",
                "Email.string"  =>  " Saisie invalide ",
                "Email.email"  =>  " Email invalide ",
                "Email.max"  =>  " 90 caractères au Max ",
                "Tel.string"  =>  " Saisie invalide ",
                "Tel.max"  =>  " Numéro de Télé invalide ",
                "Tel.min"  =>  " Numéro de Télé invalide ",
                "Tel.regex"  =>  " Numéro de Télé invalide ",
                "adresse.string"  =>  " Saisie invalide ",
                "adresse.max"  =>  " 50 caractères au Max ",
                "Ville.string"  =>  " Saisie invalide ",
                "Ville.max"  =>  " 40 caractères au Max ",
                "Occupation.string"  =>  " Saisie invalide ",
                "Occupation.max"  =>  " 20 caractères au Max ",
                "Nationnalite.string"  =>  " Saisie invalide ",
                "Nationnalite.max"  =>  " 60 caractères au Max ",
                "typeMutuel.string" =>   " Saisie invalide ",
                "typeMutuel.in" =>  " Choix invalide ",
                "ref_mutuel.string" =>  " Saisie invalide ",
                "ref_mutuel.required_with" =>  " en choisissant le type de mutuel, ce champs est obligatoire ",
                "ref_mutuel.max" =>  " Trop de caractères pour un référence ",
            ]
        );

        $patient = new Patient;
        $patient->id_civile = strtoupper( $request->input('id_civile') );
        $patient->Nom = strtoupper($request->input('Nom')); 
        $patient->Prenom = ucfirst(  strtolower($request->input('Prenom')) );
        $patient->Sexe = $request->input('Sexe');

        $patient->Tel = $request->input('Tel')? $request->input('Tel'):null ;
        $patient->Email = $request->input('Email')? $request->input('Email'):null ;
        $patient->adresse= $request->input('adresse')? $request->input('adresse'):null ;
        $patient->Ville = $request->input('Ville')? ucfirst(  strtolower($request->input('Ville')) ):null ;
        $patient->DateNaissance= $request->input('DateNaissance')? $request->input('DateNaissance'):null ;
        $patient->Occupation= $request->input('Occupation')? ucfirst(  strtolower($request->input('Occupation')) ):null ;
        $patient->Nationnalite= $request->input('Nationnalite')? ucfirst(  strtolower($request->input('Nationnalite')) ):null ;
        $patient->typeMutuel= $request->input('typeMutuel')? $request->input('typeMutuel'):null ;
        $patient->ref_mutuel= $request->input('ref_mutuel')? strtoupper( $request->input('ref_mutuel') ) : null ;

        $res = $patient->save();

        if($res)
            return response()->json(['status'=>'good']);
        return response()->json(['status'=>'err']);
    }

    public function update(Request $request, $id){

        $patient = Patient::find($id);

        if( empty($patient) )
            return response()->json(['status'=>'err']);

        $this->validate($request,
            [
                "Nom"   =>  "required|string|max:30",
                "Prenom"   =>  "required|string|max:30",
                "id_civile"   =>  "required|string|max:30|min:5|unique:patients,id_civile,".$id.",id",
                "Sexe"  =>  [ 'required', 'string', Rule::In(['homme','femme'])],
                "DateNaissance" => "nullable|string|date|date_format:Y-m-d|before:today",
                "Email" => "nullable|string|email|max:90",
                "Tel" => "nullable|string|max:14|min:9|regex:/^[0-9+\- ]*$/i",
                "adresse" => "nullable|string|max:50",
                "Ville" => "nullable|string|max:40",
                "Occupation" => "nullable|string|max:20",
                "Nationnalite" => "nullable|string|max:60",
                "typeMutuel" => [ "nullable", "string", Rule::in(["CNSS","CNOPS","RAMED","FAR"])],
                "ref_mutuel"    => "nullable|required_with:typeMutuel|string|max:255"
            ],
            [
                "Nom.required"  =>  " Saisissez le Nom du Patient ",
                "Nom.string"  =>  " Saisie invalide ",
                "Nom.max"  =>  " 30 caractères au Max ",
                "Prenom.required"  =>  " Saisissez le Prenom du Patient ",
                "Prenom.string"  =>  " Saisie invalide ",
                "Prenom.max"  =>  " 30 caractères au Max ",
                "id_civile.required"  =>  " Saisissez l'identifiant du Patient ",
                "id_civile.string"  => " Saisie invalide ",
                "id_civile.min"  => " identifiant invalide ",
                "id_civile.max"  => " Identifiant Trop long",
                "id_civile.unique"  => " Identifiant invalide, déja enregistré !",
                "Sexe.required"  => " Choisissez le Sexe du Patient",
                "Sexe.string"  => " Choix invalide ",
                "Sexe.in"  => " Choix invalide ",
                "DateNaissance.string"  =>  " Saisie invalide ",
                "DateNaissance.date_format"  =>  " Format invalide ",
                "DateNaissance.before"  =>  " Date invalide ",
                "DateNaissance.date"  =>  " une date est expecté ",
                "Email.string"  =>  " Saisie invalide ",
                "Email.email"  =>  " Email invalide ",
                "Email.max"  =>  " 90 caractères au Max ",
                "Tel.string"  =>  " Saisie invalide ",
                "Tel.max"  =>  " Numéro de Télé invalide ",
                "Tel.min"  =>  " Numéro de Télé invalide ",
                "Tel.regex"  =>  " Numéro de Télé invalide ",
                "adresse.string"  =>  " Saisie invalide ",
                "adresse.max"  =>  " 50 caractères au Max ",
                "Ville.string"  =>  " Saisie invalide ",
                "Ville.max"  =>  " 40 caractères au Max ",
                "Occupation.string"  =>  " Saisie invalide ",
                "Occupation.max"  =>  " 20 caractères au Max ",
                "Nationnalite.string"  =>  " Saisie invalide ",
                "Nationnalite.max"  =>  " 60 caractères au Max ",
                "typeMutuel.string" =>   " Saisie invalide ",
                "typeMutuel.in" =>  " Choix invalide ",
                "ref_mutuel.string" =>  " Saisie invalide ",
                "ref_mutuel.required_with" =>  " en choisissant le type de mutuel, ce champs est obligatoire ",
                "ref_mutuel.max" =>  " Trop de caractères pour un référence ",
            ]
        );
        
        
        $patient->id_civile = strtoupper( $request->input('id_civile') );
        $patient->Nom = strtoupper( $request->input('Nom') ); 
        $patient->Prenom = ucfirst( strtolower( $request->input('Prenom') ) );
        $patient->Tel = $request->input('Tel');
        $patient->Email = $request->input('Email');
        $patient->Sexe = $request->input('Sexe');
        $patient->adresse= $request->input('adresse');
        $patient->Ville =  ucfirst( strtolower( $request->input('Ville') ) );
        $patient->DateNaissance= $request->input('DateNaissance');
        $patient->Occupation= ucfirst( strtolower( $request->input('Occupation') ) );
        $patient->Nationnalite= ucfirst( strtolower( $request->input('Nationnalite') ) );
        $patient->typeMutuel= $request->input('typeMutuel');
        $patient->ref_mutuel= $request->input('ref_mutuel');
  
        $res= $patient->save();

        if($res)
            return response()->json(['status'=>'good']);
        return response()->json(['status'=>'err']);
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