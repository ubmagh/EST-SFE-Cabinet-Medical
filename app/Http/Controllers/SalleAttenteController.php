<?php

namespace App\Http\Controllers;

use App\Patient;
use Carbon\Carbon;
use App\Rendezvous;
use App\SalleAttente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SalleAttenteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
   

      $name= Auth::guard('secretaire')->user()->Nom.' '.Auth::guard('secretaire')->user()->Prenom;
      

      $rdvs= Rendezvous::whereDate('DateTimeDebut', '=' , Carbon::today()->toDateString() )
                                     ->where('Statut' , '=' , 'En cours')
                                     ->orderBy('DateTimeDebut', 'asc')
                                     ->get();
      
        /* 
        #Cette Requette Avec Laravel Elequent a une ambiguité lors d'ordonnancements des lignes
        # J'utiliserai une requette sql normal pour ce prb
       #
        $liste_attente = SalleAttente::select(DB::raw('salle_attentes.*, rendezvouses.id as RendezVousID, rendezvouses.DateTimeDebut, rendezvouses.DateTimeFin, rendezvouses.Description, rendezvouses.SecretaireId, rendezvouses.Statut')) 
       ->leftJoin('rendezvouses','salle_attentes.rdvID','=','rendezvouses.id')
                                    ->whereNull('ConsultationID')// pas encore consulter 
                                    ->whereDate('DateArrive', '=' , Carbon::today()->toDateString() ) /// d'aujourd'hui 
                                    ->where('Quitte','=',0) // (and) et n'est pas quitté
                                    ->OrderBy('startTime','DESC') /// avoir en premier le patient qui a le time de consultation saisi, c-a-d avoir en premier le patient qui est consulté
                                    ->OrderBy('Urgent','DESC') /// Avoir les cas urgentes en Premier
                                    ->orderByRaw('( TIMESTAMPDIFF(MINUTE,CURRENT_TIMESTAMP,DateTimeDebut) <= 35)','DESC') /// anticiper les rdv ayants 35 min au min resté
                                    ->OrderBy('DateArrive','ASC')
                                    ->get()
                                    ;*/

        $liste_attente= DB::select("
        SELECT salle_attentes.*, rendezvouses.id as RendezVousID, rendezvouses.DateTimeDebut, rendezvouses.DateTimeFin, rendezvouses.Description, rendezvouses.SecretaireId, rendezvouses.Statut FROM `salle_attentes` LEFT JOIN rendezvouses ON salle_attentes.rdvID=rendezvouses.id WHERE ConsultationID IS NULL AND CURDATE()=DATE(DateArrive) AND Quitte=0 ORDER BY startTime DESC, Urgent DESC, ( TIMESTAMPDIFF(MINUTE,CURRENT_TIMESTAMP,DateTimeDebut) <= 35) DESC, DateArrive ASC
        ");                      

        $patients = [];
        $h=1;
        foreach( $liste_attente as $row ){
            $patient = Patient::find($row->PatientId);
            $patients["".$row->id] = " <h6 class='timeline-title'>$h- ".$patient->Nom.' '.$patient->Prenom.'</h6>';
            $h++;
        }

        //return $liste_attente;
        return view('Secretaire.liste_attente.index', ['name'=> $name ,'rdv_liste_attente' => $rdvs, 'patients'=>$patients,'liste_attente' => $liste_attente, 'i' => 0]);
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function CreateWithRdv($id)
    {
        $rdv = Rendezvous::find($id);
        if(empty($rdv))
            return response()->json(['status'=>'NotFound'],422);
        
        $rdv->Statut = "present";
        $rdv->update();
        $res=SalleAttente::create([
            "PatientId" => $rdv->PatientId,
            'ConsultationID'    =>  null,
            'rdvID' =>  $rdv->id,
            'SecretaireID'  =>  Auth::guard('secretaire')->user()->id,
            'Urgent'    =>  false,
            'Quitte'    =>  false,
            'startTime' =>  null,
          ]); 
        if($res)
            return response()->json(['status'=>'done']);
        return response()->json(['status'   =>  'err'],422);
    }

    public function CreateWithoutRdv(Request $request){

        $this->validate( $request,
        [
            'id_civile' =>   'required|exists:patients',
        ],
        [
            'id_civile.required'    =>  'Patient introuvable',
            'id_civile.exists'    =>  'Patient introuvable']
        );

        $sec = Auth::guard('secretaire')->user(); 
        $patient = Patient::where("id_civile",$request->input('id_civile'))->first();

        // vérifier si le patient existe déjà à la liste d'attente
        $nbr = SalleAttente::where('PatientId',$patient->id)
                                ->whereDate('DateArrive', '=' , Carbon::today()->toDateString() ) /// venu aujourd'hui
                                ->where('Quitte','=',0) //  n'a pas quitté
                                ->whereNull('ConsultationID')// pas encore consulté 
                                ->get();
        
        if(count($nbr))
            return response()->json(['status'=>'error','message'=>'Patient existe déjà à la liste d\'attente. '],422);
                                

        $obj = new SalleAttente();
        $obj->PatientId = $patient->id;
        $obj->ConsultationID = null;
        $obj->rdvID = null;
        $obj->SecretaireID = $sec->id;
        $obj->Urgent = false;
        $obj->Quitte = false;
        $obj->startTime = null;

        $res= $obj->save();

        if($res)
            return response()->json(['status'=>'Done','message'=>' Patient Ajouté '],200);
        else
            return response()->json(['status'=>'error','message'=>'une Erreur Servenue.'],422);

    }



    public function GoNextPatient(Request $request,$id){

        if(!ctype_digit($id))
            return response()->json(['status'=>'error','message'=>'Données Reçues sont invalides !'],422);

        $obj = SalleAttente::find($id);
        if(empty($obj))
            return response()->json(['status'=>'error','message'=>'Patient Introuvable !'],422);

        # Avant de passer quelqu'un il faut vérifier la disponiblité
        $Attendants= SalleAttente::whereNull('ConsultationID')// pas encore consulter 
                                ->whereDate('DateArrive', '=' , Carbon::today()->toDateString() ) /// d'aujourd'hui 
                                ->where('Quitte','=',0)
                                ->whereNotNull('startTime')->get();
        
        if(count($Attendants))
            return response()->json(['status'=>'error','message'=>'La Consultation est indisponible attendez que le medcin fini avec un patient.'],200);

        // if no body there so add the requesteed one
        $obj->startTime= date('H:i:s');
        $res = $obj->update();
        if($res)
            return response()->json(['status'=>'Done','message'=>' Opération Effectuée '],200);
        else
            return response()->json(['status'=>'error','message'=>'une Erreur Servenue.'],422);
    }


    public function UrgentPatient(Request $request,$id){

        if(!ctype_digit($id))
            return response()->json(['status'=>'error','message'=>'Données Reçues sont invalides !'],422);

        $obj = SalleAttente::find($id);
        if(empty($obj))
            return response()->json(['status'=>'error','message'=>'Patient Introuvable !'],422);

       
        
        if($obj->Urgent)
            return response()->json(['status'=>'error','message'=>'Patient est déjà en Urgence .'],200);

        // if no body there so add the requesteed one
        $obj->Urgent= true;
        $res = $obj->update();
        if($res)
            return response()->json(['status'=>'Done','message'=>' Opération Effectuée  '],200);
        else
            return response()->json(['status'=>'error','message'=>'une Erreur Servenue.'],422);
    }

    
    public function UnUrgentPatient(Request $request,$id){

        if(!ctype_digit($id))
            return response()->json(['status'=>'error','message'=>'Données Reçues sont invalides !'],422);

        $obj = SalleAttente::find($id);
        if(empty($obj))
            return response()->json(['status'=>'error','message'=>'Patient Introuvable !'],422);

       
        
        if(!$obj->Urgent)
            return response()->json(['status'=>'error','message'=>'Patient n\'est pas en Urgence .'],200);

        // if no body there so add the requesteed one
        $obj->Urgent= false;
        $res = $obj->update();
        if($res)
            return response()->json(['status'=>'Done','message'=>' Opération Effectuée  '],200);
        else
            return response()->json(['status'=>'error','message'=>'une Erreur Servenue.'],422);
    }


    public function QuitPatient(Request $request,$id){

        if(!ctype_digit($id))
            return response()->json(['status'=>'error','message'=>'Données Reçues sont invalides !'],422);

        $obj = SalleAttente::find($id);
        if(empty($obj))
            return response()->json(['status'=>'error','message'=>'Patient Introuvable !'],422);        
        // if no body there so add the requesteed one
        $obj->Quitte= true;
        $res = $obj->update();
        if($res)
            return response()->json(['status'=>'Done','message'=>' Opération Effectuée  '],200);
        else
            return response()->json(['status'=>'error','message'=>'une Erreur Servenue.'],422);
    }


    public function UndoRdvConfirmation(Request $request, $id){

        if(!ctype_digit($id))
            return response()->json(['status'=>'error','message'=>'Données Reçues sont invalides !'],422);
        
        $obj = SalleAttente::find($id);
        
        if(!$obj->rdvID)
            return response()->json(['status'=>'error','message'=>' Le patient n\'a pas un rendez-vous. '],422);

        $rdv = Rendezvous::find($obj->rdvID);
        $rdv->Statut = "En cours";
        $rdv->update();
        
        $res = $obj->delete();

        if($res)
            return response()->json(['status'=>'Done','message'=>' Opération Effectuée  '],200);
        else
            return response()->json(['status'=>'error','message'=>'une Erreur Servenue.'],422);
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}