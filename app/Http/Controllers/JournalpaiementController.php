<?php

namespace App\Http\Controllers;

use App\Facture;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JournalpaiementController extends Controller
{
    


    public function journal_paiement(){
        $name = Auth::guard('secretaire')->user()->Nom.' '.Auth::guard('secretaire')->user()->Prenom;
        $journal= Facture::orderBy('Date', 'desc')->get();
        
        return view('Secretaire.Journal_Paiement.index',[ 'name'     => $name,
                                                          'journal'  => $journal
                                                        ]);            

    } 


    public function categorie_paiement(Request $request){
        $journal = "";
        $name = Auth::guard('secretaire')->user()->Nom.' '.Auth::guard('secretaire')->user()->Prenom;
            if($request->tmp == "consultation"){
                $journal = Facture::whereNotnull('ConsultationId')
                                    ->orderBy('Date', 'desc')                                 
                                    ->get();
                              return view('Secretaire.Journal_Paiement.Bycategorie', [     'name'     => $name,
                                                             'journal'  => $journal                                                            
                                                        ]);                   
            }
            else
            {
                    $journal = Facture::wherenull('ConsultationId')
                    ->orderBy('Date', 'desc')
                    ->get();
                    return view('Secretaire.Journal_Paiement.Bycategorie', [     'name'     => $name,
                    'journal'  => $journal                                                            
                ]);           
                   
            }       
           

            

    }


}
