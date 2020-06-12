<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

use App\Certificat;
use Illuminate\Support\Facades\DB;
use App\Patient;
use App\Cabinet;
use Carbon\Carbon;


use PDF;


class CertificatController extends Controller
{
    public function index (Request $request){

        $user = Auth::guard('medcin')->user();
        $name= $user->Nom.' '.$user->Prenom;

        return view( 'Medcin.Certificat.index', ['name'=>$name]);

    }

    public function store(Request $request)

    {

        $data = new Certificat();
        $patient = Patient::where('id_civile', $request->input('id_patient'))->first();

        $data->PatientId = $patient->id;
        $data->Motif = $request->input('motif');
        $data->Duree = $request->input('duree');

        $data->save();



        $cabinet = Cabinet::all()->first();
        $medecin = Auth::guard('medcin')->user();
        $date = Carbon::today()->toDateString();

        $pdf_certificat = PDF::loadview('Medcin.Certificat.CertiPDF',
        ['cabinet'=>$cabinet, 'medecin'=>$medecin, 'patient'=>$patient, 'data'=>$data, 'date'=>$date]);
        $customPaper = array(0, 0, 792.00, 1224.00);
        $pdf_certificat->setPaper($customPaper);
       return $pdf_certificat->stream('ordonnance.pdf');
       


    }

    public function show($id)
    {
      
    }
}
