<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

use App\Certificat;
use Illuminate\Support\Facades\DB;
use App\Patient;
use App\Cabinet;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;

use PDF;


class CertificatController extends Controller
{
    public function index (Request $request){

        $user = Auth::guard('medcin')->user();
        $name= $user->Nom.' '.$user->Prenom;
        DB::statement(DB::raw('SET @i = 0'));

        $q = filter_var( $request->input('q'), FILTER_SANITIZE_STRING);

        if( $q )
            $certfs  =  Certificat::select(DB::raw("  @i := @i + 1 AS num, certificats.id as id,certificats.* "))
                                    ->leftJoin('patients','PatientId','patients.id')
                                    ->where( 'medcinId', $user->id)
                                    ->where('Nom','LIKE',"%".$q."%")
                                    ->orWhere('Prenom','LIKE',"%".$q."%")
                                    ->orWhere('id_civile','LIKE',"%".$q."%")
                                    ->orWhere('certificats.date','LIKE',"%".$q."%")
                                    ->orWhere('motif','LIKE',"%".$q."%")
                                    ->orWhere('Duree','LIKE',"%".$q."%")
                                    ->OrderBy('date','DESC')->paginate(9);
        else
            $certfs  =  Certificat::select(DB::raw("  @i := @i + 1 AS num, certificats.* "))
                                    ->where( 'medcinId', $user->id)
                                    ->OrderBy('date','DESC')->paginate(9);

        return view( 'Medcin.Certificat.index', [ 'name'=>$name, 'certfs'=>$certfs,'q'=>$q ]);
    }


    public function createForm(Request $request){
        $user = Auth::guard('medcin')->user();
        $name= $user->Nom.' '.$user->Prenom;

        if( $id= $request->input('patient') ){
            $patient = Patient::find( $id );
        return view( 'Medcin.Certificat.CreateForm', [ 'name'=>$name, 'patient'=>$patient ]);

        }

        return view( 'Medcin.Certificat.CreateForm', [ 'name'=>$name ]);
    }

    public function store(Request $request){
        

        $validator = Validator::make($request->all(),
        [
            'id_civile' =>  "required|string|exists:patients,id_civile",
            'motif' =>  "required|string|max:255",
            'duree' =>  "required|string|max:30"
        ],
        [
            'id_civile.required'    =>  " Choisissez le Patient ",
            'id_civile.string'    =>  " Données erronées ",
            'id_civile.exists'    =>  " Patient Introuvable ",
            'motif.required'    =>  'Donnez un motif/raison pour le certificat',
            'motif.string'    =>  'Données erronées',
            'motif.max'    =>  ' svp 255 caractères au Max !',
            'duree.required'    =>  'Donnez une Durée pour le certificat',
            'duree.string'    =>  'Données erronées',
            'duree.max'    =>  'svp 30 caractères au Max !',
            
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        $data = new Certificat();
        $patient = Patient::where('id_civile', $request->input('id_civile'))->first();
        $medecin = Auth::guard('medcin')->user();
        $data->PatientId = $patient->id;
        $data->Motif = $request->input('motif');
        $data->Duree = $request->input('duree');
        $data->medcinId = $medecin->id;
        
        
        $res = $data->save();

        if($res)
            return redirect('CreateCertificat')->with(['status'=> 'good', 'CertfId'=>$data->id  ]);
        return redirect('CreateCertificat')->with('status', 'err');


    
    }


    public function printCert(Request $request, $id){
        $data = Certificat::findOrFail($id);
        $medecin = Auth::guard('medcin')->user();

        if( $data->medcinId !=  $medecin->id )
            abort(404);

        $patient = $data->patient;

        $cabinet = Cabinet::all()->first();
        $date = Carbon::today()->toDateString();

        $pdf_certificat = PDF::loadview( 'Medcin.Certificat.CertiPDF', ['cabinet'=>$cabinet, 'medecin'=>$medecin, 'patient'=>$patient, 'data'=>$data, 'date'=>$date]);
        
        $pdf_certificat->setPaper('A4','portrait');

        return $pdf_certificat->stream('Certificate.pdf');

    }

    public function destroy($Deletedid){

        $Certificat = Certificat::findOrFail($Deletedid);
        $Certificat->delete();
    
    }

    public function show($id)
    {
      
    }
}
