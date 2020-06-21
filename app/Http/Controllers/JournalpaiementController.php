<?php

namespace App\Http\Controllers;

use App\Facture;
use App\Paiment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;



class JournalpaiementController extends Controller
{
    


    public function journal_paiement(Request $request){
        $user=  Auth::guard('secretaire')->user();
        $name = $user->Nom.' '.$user->Prenom;

        $current = $request->input('page') ? $request->input('page') : 1 ;

        $typeConsulte = $request->input('recettes') ? "recettes" : "none" ;

        if($typeConsulte=="none")
            $typeConsulte = $request->input('depenses') ? "depenses" : "none" ;

        
        $q = filter_var( $request->input('q'), FILTER_SANITIZE_STRING);
        if( $q ){
            
            // cas de recherche

            if($typeConsulte=="none") /// afficher tout
            $paiements = Paiment::wherein('FactureId',function($qeury)use($q){
                                    $qeury->select('id')->from('factures')->wherein( 'ConsultationId',function($qeury1)use($q){
                                        $qeury1->select('id')->from('consultations')->wherein( 'PatientId',function($qeury2)use($q){
                                            $qeury2->select('id')->from('patients')->where( 'Nom' , 'LIKE', '%'.$q.'%')
                                                                                    ->orWhere( 'Prenom', 'LIKE', '%'.$q.'%')
                                                                                    ->orWhere( 'id_civile', 'LIKE', '%'.$q.'%')
                                                                                    ->orWhere( 'Tel', 'LIKE', '%'.$q.'%')
                                                                                    ->orWhere( 'Email', 'LIKE','%'.$q.'%')
                                                                                    ->orWhere( 'ref_mutuel', 'LIKE', '%'.$q.'%');
                                        });
                                    });
                                })
                                ->orWhere('date','LIKE','%'.$q.'%')
                                ->orWhere('Motif','LIKE','%'.$q.'%')
                                ->OrderBy('date', 'desc')->orderby('FactureId')->orderby('Motif')->paginate(12);

            else if($typeConsulte=="recettes") // recettes => facture id not null
                    $paiements = Paiment::wherein('FactureId',function($qeury)use($q){
                        $qeury->select('id')->from('factures')->wherein( 'ConsultationId',function($qeury1)use($q){
                            $qeury1->select('id')->from('consultations')->wherein( 'PatientId',function($qeury2)use($q){
                                $qeury2->select('id')->from('patients')->where( 'Nom' , 'LIKE', '%'.$q.'%')
                                                                        ->orWhere( 'Prenom', 'LIKE', '%'.$q.'%')
                                                                        ->orWhere( 'id_civile', 'LIKE', '%'.$q.'%')
                                                                        ->orWhere( 'Tel', 'LIKE', '%'.$q.'%')
                                                                        ->orWhere( 'Email', 'LIKE','%'.$q.'%')
                                                                        ->orWhere( 'ref_mutuel', 'LIKE', '%'.$q.'%');
                            });
                        });
                    })
                    ->orWhere('Motif','LIKE','%'.$q.'%')
                    ->wherenotnull('FactureId')
                    ->OrderBy('date', 'desc')->orderby('FactureId')->orderby('Motif')->paginate(12);
            
            else //dépenses
                $paiements = Paiment::wherenull('FactureId')
                ->Where('Motif','LIKE','%'.$q.'%')
                ->OrderBy('date', 'desc')->orderby('FactureId')->orderby('Motif')->paginate(12);

        }else{

            if($typeConsulte=="none")
                $paiements= Paiment::orderBy('date', 'desc')->orderby('FactureId')->orderby('Motif')->paginate(12);
            else if($typeConsulte=="recettes")
                $paiements= Paiment::wherenotnull('FactureId')->orderBy('date', 'desc')->orderby('FactureId')->orderby('Motif')->paginate(12);
            else
                $paiements= Paiment::wherenull('FactureId')->orderBy('date', 'desc')->orderby('FactureId')->orderby('Motif')->paginate(12);
        }

        return view('Secretaire.Journal_Paiement.index',[ 'name'     => $name,
                                                          'paiements'  => $paiements,
                                                          'q'=>$q, 'counter'=>$current,
                                                          'typeConsulte'    =>$typeConsulte
                                                        ]);            

    } 






    public function CreateDepense(Request $request){


        $this->validate($request,[
            'Motif' =>  'required|string|max:100',
            'Montant' =>  'required|string|regex:/^\d*[.]?\d*$/i|min:0',
        ],[
            "Motif.required"    =>  "Un motif pour la dépense est nécessaire",
            "Motif.string"    =>  "Saisie Invalide",
            "Motif.max"    =>  "Utilisez 100 caractères au Max",
            "Montant.required"    =>  " Impossible de laisser ce champ vide ",
            "Montant.string"    =>  "Saisie Invalide",
            "Montant.regex"    =>  "Montant Invalide",
            "Montant.min"    =>  "Montant Invalide",
        ]);

        $pa  = new Paiment();
        $pa->Motif = $request->input("Motif");
        $pa->Montant = doubleval(  $request->input("Montant")  );
        $pa->FactureId = null;
        $pa->date = date('Y-m-d');
        $res =  $pa->save();
        
        if($res)
            return response()->json(["status"=>"OK"]);
        return response()->json(["status"=>"Not OK"]);
    }


    public function DeleteDepense( Request $request, $id){

        $pa = Paiment::findOrFail($id);

        if($pa->delete())
        return response()->json(['status'=>"Done"]);
        return response()->json(['status'=>"Err"]);
    }



}
