<?php

namespace App\Http\Controllers;


use DateTime;
use App\Patient;
use Carbon\Carbon;
use App\Rendezvous;
use App\Rules\notBetweenTwoDateTimes;
use App\Secretaire;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
              "start" => $rdv->DateTimeDebut,
              "end" => $rdv->DateTimeFin,
              "textColor" => "white",//dakhla manuelle hit khasha darori tkon f parametre dial calendar(documentation..)             
            ];
          array_push($rdvArray, $data);
       }
        return response()->json($rdvArray);
    }

    public function autocomplete_rdv_patient(Request $request)
    {
        $data = Patient::select("id_civile as ID_c", DB::raw(" CONCAT(Nom,' ',Prenom) as name ") )
                        ->where("id_civile","LIKE","%{$request->input('query')}%")
                        ->orWhere("Prenom","LIKE","%{$request->input('query')}%")
                        ->orWhere("Nom","LIKE","%{$request->input('query')}%")
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

        // validation !!

        $last_dateTime = Rendezvous::orderBy('id','DESC')->first();
        
        $this->validate(
            $request,
            [
                'id_civile' =>   'required|exists:patients',
                'DateDebut' =>  'required|date_format:Y-m-d H:i|after_or_equal:now',
                'DateFin'   =>  'required|date_format:Y-m-d H:i|after:DateDebut',
                'Description'   =>  'nullable|max:255'
            ],
            [
                'id_civile.required'    =>  'Patient introuvable',
                'id_civile.exists'    =>  'Patient introuvable',
                'DateDebut.required' =>  'Saisissez la date de Début',
                'DateDebut.date_format' =>  'Date invalide',
                'DateDebut.after_or_equal' =>  'Date invalide',
                'DateFin.required' =>  'Saisissez la date de Fin',
                'DateFin.date_format' =>  'Date invalide',
                'DateFin.after' =>  'Date invalide',
                'Description.max'   =>  '255 caractères au Max'
            ]
        );


        if($last_dateTime)
        $this->validate(
            $request,
            [
                'DateDebut' =>  ['required','date_format:Y-m-d H:i', new notBetweenTwoDateTimes($last_dateTime->DateTimeDebut,$last_dateTime->DateTimeFin,$request->input('DateDebut'))],
            ],
            [
                'DateDebut.required' =>  'Saisissez la date de Début',
                'DateDebut.date_format' =>  'Date invalide',
                'DateDebut.notBetweenTwoDateTimes' =>  'la Date selectionné est indisponible voir le calendrier ',
            ]
        );

        // validation end


        $sec = Auth::guard('secretaire')->user(); 
        $patient = Patient::where("id_civile",$request->input('id_civile'))->first();
                                        
        $rdv = new Rendezvous();   
        $rdv->DateTimeDebut =$request->input('DateDebut');
        $rdv->DateTimeFin =$request->input('DateFin');
        $rdv->PatientId = $patient->id; 
        $rdv->SecretaireId= $sec->id ;
        $rdv->Statut = "En cours";
        $rdv->Description = $request->input('Description'); //par défaut ghatakhd en cours

        $res=$rdv->save();         
        if($res)    
            return response()->json(['status'=>'OK']);
        return response()->json(['status'=>'NOTOK']);

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