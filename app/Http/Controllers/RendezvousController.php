<?php

namespace App\Http\Controllers;


use DateTime;
use App\Patient;
use Carbon\Carbon;
use App\Rendezvous;
use App\Secretaire;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RendezvousController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function index()   
    {
        return $this->rdvsToarray(Rendezvous::all());
    }

    public function rdvsToarray($rdvs){
       
      $rdvArray =[];
       foreach( $rdvs  as $rdv)
       {
          $data = [
              "id"=>$rdv->id,
              "patient" => $rdv->patient->Nom,
              "title" => $rdv->Description.' '.$rdv->patient->Nom,
              "start" => $rdv->Date.' '.$rdv->Heure,
              "end" => $rdv->Date,
              "textColor" => "white",//dakhla manuelle hit khasha darori tkon f parametre dial calendar(documentation..)             
              "statut" => $rdv->Status
            ];
          array_push($rdvArray, $data);
       }
        return response()->json($rdvArray);
    }

    public function autocomplete_rdv_patient(Request $request)
    {
        $data = Patient::select("id_civile as name") 
                        ->where("id_civile","LIKE","%{$request->input('query')}%")
                        ->get();
        return response()->json($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $name= Auth::guard('secretaire')->user()->Nom.' '.Auth::guard('secretaire')->user()->Prenom;
        $sec = Auth::guard('secretaire')->user(); // hna kanjib secretaire li7al db db application o ghat2insere
        $patient = Patient::where("id_civile",$request->input('id_civile')) // kanjib patient li2insirit lih id civile
                          ->first();
                                        
        $rdv = new Rendezvous();   
        $rdv->Date =$request->input('Date');
        $rdv->Heure = $request->input('Heure');
        $rdv->PatientId = $patient->id; 
        $rdv->SecretaireId= $sec->id ;
        $rdv->Statut = "En cours";
        $rdv->Description = $request->input('Description'); //par défaut ghatakhd en cours
        $rdv->save();             
         return redirect('/Rendez-vous');
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $rdvID = $request->rdvID;
        $rdv =  Rendezvous::find($rdvID); 
        $rdv->Date =   $request->Date;
        $rdv->Heure =   $request->Heure;
        $rdv->save();
        return response()->json(['success' => 'updated']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         $rdv = Rendezvous::findOrFail($id);
         $rdv->delete();
         return response()->json(['success' => 'deleted']);
    }
}