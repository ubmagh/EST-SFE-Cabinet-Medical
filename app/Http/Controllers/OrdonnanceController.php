<?php

namespace App\Http\Controllers;

use App\Cabinet;
use App\Consultation;
use App\Medicament_par_ordonnance;
use App\Ordonnance;
use App\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PDF;

class OrdonnanceController extends Controller
{
    //

    public function GetOrdonnancePDF(Request $request, $ordonnanceid)
    {
        set_time_limit(0);

            
       //************************************ORDONNANCE PDF********************************************* */

       $nom= Auth::guard('medcin')->user()->Nom.' '.Auth::guard('medcin')->user()->Prenom;
       $cabinet = Cabinet::all()->first();
       $ordonnance = Ordonnance::find($ordonnanceid);
       $consultation = Consultation::find($ordonnance->ConsultationId);
        $patient = $consultation->patient;
        $medcin = $consultation->medcin;
        
       $medi = Medicament_par_ordonnance::where('OrdonnanceId', $ordonnanceid)->get();
       $pdf_ordonnance = PDF::loadview('Medcin.Consultation.ordonnance',
        ['consultation' => $consultation ,'nom'=>$nom, 'patient'=>$patient, 'cabinet'=>$cabinet
        , 'medecin'=>$medcin, 'ordonnance'=>$ordonnance, 'medi'=>$medi]);
        $customPaper = array(0, 0, 792.00, 1224.00);
        $pdf_ordonnance->setPaper($customPaper);
       return $pdf_ordonnance->stream('ordonnance.pdf');
       
       /*
       return view('Medcin.Consultation.ordonnance',
       ['consultation' => $consultation ,'nom'=>$nom, 'patient'=>$patient, 'cabinet'=>$cabinet
       , 'medecin'=>$medcin, 'ordonnance'=>$ordonnance, 'medi'=>$medi]);
       */

    }

}