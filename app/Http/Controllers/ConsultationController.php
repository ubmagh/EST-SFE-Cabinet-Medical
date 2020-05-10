<?php

namespace App\Http\Controllers;
use App\Consultation;
use App\Medcin;
use App\Secretaire;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class ConsultationController extends Controller
{
    public function index(Request $request)
    { 
        $name= Auth::guard('medcin')->user()->Nom.' '.Auth::guard('medcin')->user()->Prenom;

        $consultations = Consultation::all()->toArray();
        $medecins = Medcin::all()->toArray();
        $secretaires = Secretaire::all()->toArray();

        return view('Medcin.Consultation.index',
        ['name'=>$name,'consultations'=>$consultations,'medecins'=>$medecins , 
        'secretaires'=>$secretaires ,'counter'=>0]);
    }
}