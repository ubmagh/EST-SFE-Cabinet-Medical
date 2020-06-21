<?php

namespace App\Http\Controllers\Dachboard;

use DateTime;
use App\Patient;
use Carbon\Carbon;
use App\Rendezvous;
use App\Consultation;
use App\salleAttente;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SecretaireController extends Controller
{   

            // Nombre des rendez-vous d'aujourd'hui   

        public function getNb_rdv(){
            $date_now = Carbon::now();
               return $nb = Rendezvous::wheredate('DateTimeDebut', $date_now->toDateString('Y-m-d'))->get()->count();
        }

        public function getNb_attente(){
             $date_now = Carbon::now();
             return  $nb = salleAttente::wheredate('DateArrive',  $date_now->toDateString('Y-m-d'))  
                                 ->where('Quitte' , 0)      
                                 ->whereNull('ConsultationID')
                                 ->whereNull('startTime')                         
                                 ->get()
                                 ->count();
                            
        }
        
        public function getNb_urgence(){
            $date_now = Carbon::now();
            return  $nb = salleAttente::wheredate('DateArrive',  $date_now->toDateString('Y-m-d'))  
                                ->where('Quitte' , 0)   
                                ->where('Urgent', 1)                            
                                ->get()
                                ->count();
        }

        public function getNb_consultation(){
            $date_now = Carbon::now();
            return  $nb = Consultation::wheredate('Date',  $date_now->toDateString('Y-m-d'))                           
                                ->get()
                                ->count();
        }


        public function getListe_rdv(){
            $date_now = Carbon::now();
            return $nb = Rendezvous::wheredate('DateTimeDebut', $date_now->toDateString('Y-m-d'))
                                   ->where('Statut', "En cours")
                                    ->get();
        }

    

       

    
 


















  

        


}
