<?php

namespace App\Http\Controllers;

use DateTime;
use App\Facture;
use App\Paiment;
use App\Patient;
use Carbon\Carbon;
use App\Consultation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Operations_Selon_Consultation;
use DB;

class PaimentController extends Controller
{

                        //  1-paiement function
  
    public function liste_paiement($id){
        $name = Auth::guard('secretaire')->user()->Nom.' '.Auth::guard('secretaire')->user()->Prenom;
        $patient = Patient::findOrFail($id);
        $Nombre_consultation = Consultation::where('PatientId', $patient->id)
                                            ->get()
                                            ->count();
        
        DB::statement(DB::raw('SET @i = 0'));
        
        $facture = Facture::select(DB::raw("  @i := @i + 1 AS num, factures.*"))
                                            ->wherein('ConsultationId',function($q)use($patient){
                                                                $q->select('id')->from('consultations')->where('PatientId' , $patient->id);
                                                    })->get();  
                                                 
        return view('Secretaire.Paiement.index',[  'name'   => $name,
                                                    'patient'   =>  $patient,
                                                   'Nombre_consultation'    =>  $Nombre_consultation,                                                                                
                                                   'facture'    =>  $facture  
                                                ]);
    }




     public function detail_paiment($id){
          $facture =  Facture::FindOrFail($id);
          $paiement = Paiment::where('FactureId', $facture->id)
                              ->get();
          $operation_selon_consultation = Operations_Selon_Consultation::where('ConsultationID', $facture->ConsultationId)
                                                     ->get();

            $Array =[];
                foreach ($operation_selon_consultation as $row) {
                            $array_operation=[
                                "type" => $row->operation->Intitule,
                                "prix" => $row->operation->Prix
                            ];
                        array_push($Array, $array_operation);
                }

        return response()->json([
                'paiement'   =>$paiement,
                'operation'  =>$Array
            ]);
          
     }




     public function paiement($id, Request $request){
        $facture= Facture::findorfail($id);

        $prix = doubleval( $request->input('paiement') );
        
        if(  $facture->Somme > $facture->Paye && $facture->Somme  >= ($prix + $facture->Paye) ){
            $facture->Paye+=$prix;
            $paiement = Paiment::create([
                        "date"  =>  date("Y-m-d"),
                        'Montant'   => $prix,
                        'FactureId' =>  $facture->id,
                    ]);
            if(  $facture->save() && $paiement  )                      
                        return response()->json(['paiement'=>"fait"]);

            return response()->json(['paiement' => 'erreur']);
        }

        return response()->json(['paiement' => 'erreur']);

    }




      

 
}

