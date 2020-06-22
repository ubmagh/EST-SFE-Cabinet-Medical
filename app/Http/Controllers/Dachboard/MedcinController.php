<?php

namespace App\Http\Controllers\Dachboard;

use App\Facture;
use App\Paiment;
use App\Patient;
use Carbon\Carbon;
use App\Rendezvous;
use App\Consultation;
use App\salleAttente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class MedcinController extends Controller
{
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




            
             // for charts patients(by day,year,month)
         



        public function getAll_year(){
            return $year = Patient::selectraw('year(created_at) as year')->distinct()->orderby('year')->pluck('year');
        }
        public function getAll_month($year){
             return $month = Patient::selectraw('month(created_at) as month')->whereyear('created_at',$year)->distinct()->orderby('month')->pluck('month');            
        }
  


      public function getYearPatientData(){  
        $query=$this->getAll_year();     
        $patient_year_count_array=array();
        for ($i=0; $i < $query->count() ; $i++) { 
          $nb =  Patient::whereyear('created_at',$query[$i])->get()->count();
          array_push($patient_year_count_array, $nb);
        }
        $monthly_post_data_array = array(
            'months' => $query,
             'post_count_data' => $patient_year_count_array
            );
    
            return response()->json($monthly_post_data_array); 
    }

        public function getMonthPatientData(Request $request){  
            if( count( $request->all() ) == 1 ){      
                $query= $this->getAll_month($request->tmp);  
                $patient_month_count_array=array();     
                $month = array("janvier", "février", "mars", "avril", "mai", "juin", "juillet", "août", "septembre", "octobre", "novembre", "décembre");
                    for ($i=0; $i < ($query->count()) ; $i++) { 
                            for ($j=0; $j < 12 ; $j++) { 
                                if($query[$i] === $j) 
                                    $month_array[$query[$i]]= $month[$j-1];           
                            }
                    }            
                foreach ($month_array as $index => $value) {
                    $nb = Patient::whereyear('created_at', $request->tmp)
                                    ->wheremonth('created_at', $index) 
                                    ->get()->count();
                                    array_push($patient_month_count_array, $nb);
                } 
                    return response()->json([
                        'months' => $month_array,
                        'patient_count_data' => $patient_month_count_array
                    ]);
                 
            }
            else if(count( $request->all() ) == 2 ){
                $dt = Carbon::createFromDate($request->tmp, $request->tmp_1);
                $patient_day_count_array=array();
                    for($k=0 ; $k< $dt->daysInMonth ; $k++){
                        $nb = Patient::whereyear('created_at', $request->tmp)
                                    ->wheremonth('created_at', $request->tmp_1)
                                    ->whereday('created_at', $k+1) 
                                    ->get()->count();
                                    $patient_day_count_array[$k+1]= $nb; 
                    }
                    return response()->json([
                        'day' => $patient_day_count_array
                    ]);
            }

        }



         
         // charts for comptabilité(by recettes,dépenses)
         

        public function getAllYear_compta(){
            return $year_facture_=Paiment::selectraw('year(date) as year')->distinct()->orderby('year')->pluck('year'); 
        }
        public function getAllmonth_compta($year){
            return $year_facture_=Paiment::selectraw('Month(date) as month')->whereyear('Date', $year)->distinct()->orderby('month')->pluck('month'); 
        }

            
        public function getYearCompta(){ 
            $year_facture=$this->getAllYear_compta();
               $data=[];
                   if(!empty($year_facture)){
                        for($i = 0 ; $i< $year_facture->count() ; $i++){
                            $a= (Paiment::selectraw('sum(Montant) as Paye')
                                ->whereyear('date', $year_facture[$i])
                                ->wherenotnull('FactureId')
                                ->pluck('Paye'));
                            $b=(Paiment::selectraw('sum(Montant) as Paye')
                            -> whereyear('date', $year_facture[$i])
                            ->wherenull('FactureId')
                            ->pluck('Paye'));  
                            $da = [
                                "Année"=>$year_facture[$i],
                                "Recette" => $a[0],
                                "Dépense" => $b[0]
                                ];                                  
                            array_push($data, $da);
                        } 
                    return $data;       
                    }
                return $data;    
                     
        }
    
       

        public function getMonthCompta(Request $request){ 
            $data=[];  
            if( count( $request->all() ) == 1 ){                    
                $query= $this->getAllmonth_compta($request->tmp);  
                $patient_month_count_array=array();     
                $month = array("janvier", "février", "mars", "avril", "mai", "juin", "juillet", "août", "septembre", "octobre", "novembre", "décembre");
                if(!empty($query)){
                    for ($i=0; $i < ($query->count()) ; $i++) { 
                            for ($j=0; $j < 12 ; $j++) { 
                                if($query[$i] === $j){
                                     $a= (Paiment::selectraw('sum(Montant) as Paye')
                                    -> whereyear('date', $request->tmp)
                                    ->wheremonth('date', $query[$i] )
                                    ->wherenotnull('FactureId')
                                    ->pluck('Paye'));
                                    $b=(Paiment::selectraw('sum(Montant) as Paye')
                                    -> whereyear('date', $request->tmp)
                                    ->wheremonth('date', $query[$i] )
                                    ->wherenull('FactureId')
                                    ->pluck('Paye'));  
                                    $da = [
                                        "Mois"=> $month[$j-1],
                                        "Recette" => $a[0],
                                        "Dépense" => $b[0]
                                        ];                                  
                                    array_push($data, $da);   
                                }                                             
                            }
                    }
                    return response()->json( ['data' => $data,
                                       'month_number'  => $query                                            
                    ]); 

                } 
                        
                  
            }

            else  if( count( $request->all() ) == 2 ){        
                $dt = Carbon::createFromDate($request->tmp, $request->tmp_1);
                for($k=0 ; $k< $dt->daysInMonth ; $k++){
                    $a =(Paiment::selectraw('sum(Montant) as Paye')
                                ->whereyear('date', $request->tmp)
                                ->wheremonth('date', $request->tmp_1)
                                ->whereday('date', $k+1) 
                                ->wherenotnull('FactureId')
                                ->pluck('Paye'));
                    $b =(Paiment::selectraw('sum(Montant) as Paye')
                                ->whereyear('date', $request->tmp)
                                ->wheremonth('date', $request->tmp_1)
                                ->whereday('date', $k+1) 
                                ->wherenull('FactureId')
                                ->pluck('Paye'));            
                                $day = [
                                    "Jours"=> $k+1,
                                    "Recette" => $a[0],
                                    "Dépense" => $b[0]
                                    ];                                  
                                array_push($data, $day);   
                                       
                }           
                  return response()->json( ['data' => $data,                                         
                    ]); 
                

                
                        
                  
            }






        }





        
}
