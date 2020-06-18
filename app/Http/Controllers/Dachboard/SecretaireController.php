<?php

namespace App\Http\Controllers\Dachboard;

use App\Consultation;
use App\Http\Controllers\Controller;
use App\Rendezvous;
use App\salleAttente;
use Carbon\Carbon;
use Illuminate\Http\Request;

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
        


}
