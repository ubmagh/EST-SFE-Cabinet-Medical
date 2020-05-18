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
      
       $liste_attente = SalleAttente::leftJoin('rendezvouses','salle_attentes.rdvID','=','rendezvouses.id')
                                    ->whereNull('ConsultationID')// pas encore consulter 
                                    ->whereDate('DateArrive', '=' , Carbon::today()->toDateString() ) /// d'aujourd'hui 
                                    ->where('Quitte','=',0) // (and) et n'est pas quitté
                                    ->OrderBy('startTime','DESC') /// avoir en premier le patient qui a le time de consultation saisi, c-a-d avoir en premier le patient qui est consulté
                                    ->OrderBy('Urgent','DESC') /// Avoir les cas urgentes en Premier
                                    ->orderByRaw('( TIMESTAMPDIFF(MINUTE,DateTimeDebut,CURRENT_TIMESTAMP) <= 35)','DESC') /// anticiper les rdv ayants 35 min au min resté
                                    ->select(DB::raw('salle_attentes.*, rendezvouses.id as RendezVousID, rendezvouses.DateTimeDebut, rendezvouses.DateTimeFin, rendezvouses.Description, rendezvouses.SecretaireId, rendezvouses.Statut')) 
                                    ->get()
                                    ;

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
            return response()->json(['status'=>'Done','message'=>' Effectué avec succèss '],200);
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