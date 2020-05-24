<?php

namespace App\Http\Controllers;
use App\Medcin;
use App\Cabinet;
use App\Patient;

use Carbon\Carbon;
use App\Medicament;
use App\Ordonnance;

use Illuminate\Support\Facades\DB;


use App\Consultation;

use App\salleAttente;
use  Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Medicament_par_ordonnance;
use App\Secretaire;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;

class ConsultationController extends Controller
{
    public function index(Request $request){
        $user = Auth::guard('medcin')->user();
        $name= $user->Nom.' '.$user->Prenom;

        $ListeAttentes =[];
        $consultations =[];
        $patient = (object) [];
        $found=false;
        $secretaire=null;
        $SalleAttenteEmpty= app('App\Http\Controllers\SalleAttenteController')->Check_empty_liste();

        $ListeAttentes = salleAttente::whereNotNull('startTime')
                                    ->whereNull('ConsultationID')
                                     ->whereDate('dateArrive', '=' , Carbon::today()->toDateString() )
                                     ->orderby('dateArrive' , 'desc')
                                     ->first();
        

        if (!empty($ListeAttentes)){
            $secretaire = Secretaire::find($ListeAttentes->SecretaireID);
            $consultations = Consultation::where('PatientId', $ListeAttentes->patient->id)->OrderBy('Date','DESC')->take(3)->get();                          
            $patient = $ListeAttentes->patient;
            if($patient->DateNaissance)
                $patient->age = Carbon::createFromFormat("Y-m-d", $patient->DateNaissance)->age.' ans';
            $found=true;
        }

                
        return view('Medcin.Consultation.index',
        ['name'=>$name, 'ListeAttentes'=>$ListeAttentes, 'consultations'=>$consultations, 'patient'=>$patient, 'secretaire'=>$secretaire, 'found'=>$found,'EmptySa'=>$SalleAttenteEmpty ]);
    }


    

    public function store(Request $request)
    {
    //**************************INSERT INTO CONSULTATIONS********************************************** */
        $ListeAttentes = salleAttente::whereNotNull('startTime')
                                    ->whereNull('ConsultationID')
                                    ->whereDate('dateArrive', '=' , Carbon::today()->toDateString() )
                                    ->orderby('dateArrive' , 'desc')
                                    ->first();   
        $medecin = Auth::guard('medcin')->user();
        $patient = Patient::where("id_civile",$ListeAttentes->patient->id_civile)
                          ->first();
        $consultation = new Consultation();  
        $consultation->Type =$request->input('typeConsultation');
        $consultation->Description =$request->input('Description');
        $consultation->ExamensAfaire =$request->input('analyses');
        $consultation->PatientId = $patient->id; 
        $consultation->MedcinId= $medecin->id ;
        $consultation->Urgent = $ListeAttentes->Urgent;
        $consultation->save(); 

      //***************************INSERT INTO ORDONNANCES******************************************** */

        //$consultation = DB::table('consultations')->latest('id')->first();
        $ordonnance = new Ordonnance();
        $ordonnance->ConsultationId = $consultation->id ; 
        $ordonnance->Description = $request->input('remarque');
        $ordonnance->save();

      //***************************INSERT INTO MEDICAMENT_PAR_ORDONNANCES******************************************** */
       
      
       
       //$ordonnance = DB::table('ordonnances')->latest('id')->first();
     
       $medicaments = $request->input('medicament');
        
        $all = array();

        if($medicaments)
        foreach ($medicaments as $key=>$medicament){
        
        $medi_par_ordo = new Medicament_par_ordonnance();

        
        $medi_par_ordo->Periode=$request->input('Periods')[$key];
        $medi_par_ordo->NbrParJour=$request->input('unites')[$key];
        $medi_par_ordo->MedicamentId=$medicament;
        $medi_par_ordo->OrdonnanceId=$ordonnance->id;
        
        $medi_par_ordo->save();   

       }   
       
       
    }



    public function autocomplete(Request $request)
    {
        $data = Medicament::select("Nom as name") 
                        ->where("Nom","LIKE","%{$request->input('query')}%")
                        ->get();
        return response()->json($data);
    }

    
}