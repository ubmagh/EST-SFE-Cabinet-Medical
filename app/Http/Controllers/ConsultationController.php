<?php

namespace App\Http\Controllers;
use DB;
use PDF;
use App\Medcin;
use App\Cabinet;
use App\Patient;

use Carbon\Carbon;
use App\Medicament;
use App\Ordonnance;


use App\Consultation;

use App\salleAttente;
use  Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Medicament_par_ordonnance;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;


class ConsultationController extends Controller
{
    public function index(Request $request){
        $user = Auth::guard('medcin')->user();
        $name= $user->Nom.' '.$user->Prenom;

        $ListeAttentes =[];
        $consultations =[];
        $medicaments =[];
        $found=false;
        $SalleAttenteEmpty= app('App\Http\Controllers\SalleAttenteController')->Check_empty_liste();

        $ListeAttentes = salleAttente::whereNotNull('startTime')
                                    ->whereNull('ConsultationID')
                                     ->whereDate('dateArrive', '=' , Carbon::today()->toDateString() )
                                     ->orderby('dateArrive' , 'asc')
                                     ->first();

        if (!empty($ListeAttentes)){
            $consultations = Consultation::where('PatientId', $ListeAttentes->patient->id)->get();                          
            $medicaments = Medicament::all();
            $found=true;
        }

                
        return view('Medcin.Consultation.index',
        ['name'=>$name, 'ListeAttentes'=>$ListeAttentes, 'consultations'=>$consultations, 
        'medicaments'=>$medicaments,'found'=>$found,'EmptySa'=>$SalleAttenteEmpty ]);
    }


    

    public function store(Request $request)
    {
    //**************************INSERT INTO CONSULTATIONS********************************************** */
        $ListeAttentes = salleAttente::whereNotNull('startTime')
                                    ->whereNull('ConsultationID')
                                    ->whereDate('dateArrive', '=' , Carbon::today()->toDateString() )
                                    ->orderby('dateArrive' , 'asc')
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
        if($request->input('urgent') == 'Oui'){
            $consultation->Urgent = 1;
        }else{
            $consultation->Urgent = 0;
        }
        $consultation->save(); 

      //***************************INSERT INTO ORDONNANCES******************************************** */

        $consultation = DB::table('consultations')->latest('id')->first();
        $ordonnance = new Ordonnance();
        $ordonnance->ConsultationId = $consultation->id ; 
        $ordonnance->Description = $request->input('remarque');
        $ordonnance->save();

      //***************************INSERT INTO MEDICAMENT_PAR_ORDONNANCES******************************************** */
       
      
       
       $ordonnance = DB::table('ordonnances')->latest('id')->first();
     
       $medicaments = $request->input('medicament');
        
        $all = array();

        if($medicaments)
        foreach ($medicaments as $key=>$medicament){
        
        $medi_par_ordo = new Medicament_par_ordonnance();

        $medicament = Medicament::where('Nom', $medicaments[$key])->first();


        $medi_par_ordo->Periode=$request->input('Periods')[$key];
        $medi_par_ordo->NbrParJour=$request->input('unites')[$key];
        $medi_par_ordo->MedicamentId=$medicament->id;
        $medi_par_ordo->OrdonnanceId=$ordonnance->id;
        
        $medi_par_ordo->save();   

       }   
       
       
       //************************************ORDONNANCE PDF********************************************* */

        $nom= Auth::guard('medcin')->user()->Nom.' '.Auth::guard('medcin')->user()->Prenom;
        $cabinet = Cabinet::all()->first();
        $medi = Medicament_par_ordonnance::where('OrdonnanceId', $ordonnance->id)->get();
                              
        $pdf_ordonnance = PDF::loadview('Medcin.Consultation.ordonnance',
         ['consultation' => $consultation ,'nom'=>$nom, 'patient'=>$patient, 'cabinet'=>$cabinet
         , 'medecin'=>$medecin, 'ordonnance'=>$ordonnance, 'medi'=>$medi]);
         $customPaper = array(0, 0, 792.00, 1224.00);
         $pdf_ordonnance->setPaper($customPaper);;
        return $pdf_ordonnance->stream();
        
       

      
    }



    public function autocomplete(Request $request)
    {
        $data = Medicament::select("Nom as name") 
                        ->where("Nom","LIKE","%{$request->input('query')}%")
                        ->get();
        return response()->json($data);
    }

    
}