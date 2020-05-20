<?php

namespace App\Http\Controllers;

use App\Cabinet;
use App\Medcin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class MedcinController extends Controller
{
    //
    public function __construct()
    {
       // $this->middleware('auth:medcin');
    }
   
    public function index()
    {
        return view('medcin'); /// medcin dashboard
    }

    public function Admin_Get_users_list(){
        $medcins = Medcin::all();
        return view('Admin.UsersGestion.Medcins.index')->with(['name'=>"Administrateur",'medcins'=>$medcins,'counter'=>0]);
    }


    public function Create(Request $request){

        $this->validate($request,
        [
            'Nom'   =>  'required|max:30|min:3|regex:/^[a-zA-Z0-9éèàç]+(([\',. -][a-zA-Z0-9éèàç ])?[0-9a-zA-Zéèàç]*)*$/i',
            'Prenom'   =>  'required|max:30|min:3|regex:/^[a-zA-Z0-9éèàç]+(([\',. -][a-zA-Z0-9éèàç ])?[0-9a-zA-Zéèàç]*)*$/i',
            'Email'   =>  'required|email|max:100|unique:medcins|unique:medcins|unique:cabinets,AdminEmail',
            'Pseudo'   =>  'required|max:20|min:3|alpha_num|unique:medcins',
            'password'   =>  'required|min:6',
            'Specialite'    =>  'required|min:2|regex:/^[a-zA-Z0-9éèàç]+(([\',. -][a-zA-Z0-9éèàç ])?[0-9a-zA-Zéèàç]*)*$/i',
            'Tel'   =>  'required|min:9|max:14|regex:/^[0-9+\- ]*$/i',
            'Adresse'   =>  'nullable|max:100',
        ],
        [
            'Nom.required'  =>  " Saisissez Le nom. ",
            'Nom.max'  =>  " 30 caractères au Max. ",
            'Nom.min'  =>  " le nom est très court. ",
            'Nom.regex'  =>  " Le nom saisi est invalide. ",
            'Prenom.required'  =>  " Saisissez Le prenom. ",
            'Prenom.max'  =>  " 30 caractères au Max. ",
            'Prenom.min'  =>  " le prenom est très court. ",
            'Prenom.regex'  =>  " Le prenom saisi est invalide. ",
            'Email.required'  =>  " Saisissez L'adresse Email ",
            'Email.email'  =>  " Adresse Email invalide ",
            'Email.max'  =>  " Maximum est de 100 caractères. ",
            'Email.unique'  =>  " Adresse Déjà enregistré pour un utilisateur. ",
            'Pseudo.required'  =>  " Saisissez un Pseudo-nom ",
            'Pseudo.max'  =>  " 20caractères au Max.",
            'Pseudo.min'  =>  " Pseudo-nom invalide. ",
            'Pseudo.alpha_num'  =>  " Pseudo-nom invalide. ",
            'Pseudo.unique'  =>  " Pseudo-nom déjà enregistré pour un utilisateur. ",
            'password.required' =>  " Saisissez un mot de passe ",
            'password.min' =>  " Le Mot de passe Est de 6 caractères au Min ",
            'Specialite.required'   =>  ' Entrez une spécialité ',
            'Specialite.regex'   =>  ' Caractères non alloués ',
            'Specialite.min'   =>  ' données invalides ',
            'Tel.required' =>  " Entrez le Numéro de Téléphone ",
            'Tel.min' =>  " Numéro de Téléphone invalide ",
            'Tel.max' =>  " Numéro de Téléphone invalide ",
            'Tel.regex' =>  " Numéro de Téléphone invalide ",
            'Adresse.max' =>  " 100 Caractères au Max. ",
        ]);

        $res = Medcin::create([
            'Nom'   =>  $request->input('Nom'), 
            'Prenom' =>  $request->input('Prenom'),
            'Email' =>  $request->input('Email'),
            'Pseudo' =>  $request->input('Pseudo'),
            'password' =>  Hash::make($request->input('password')),
            'Tel' =>  $request->input('Tel'),
            'Specialite' =>  $request->input('Specialite'),
            'Signature' =>  ' ',
            'Adresse' =>  $request->input('Adresse'),
            'DernierLog' =>  json_encode(['last'=>'','first'=>'']),
            'remember_token'    =>  null,
            'created_at'    => date('Y-m-d H:i:s')
        ]);

        if($res){
            return response()->json(['status'=>'OK']);
        }else{
            return response()->json(['status'=>'NotOk']);
        }
    }


    public function Update(Request $request){

        $id= $request->input('id');
        $medcin = Medcin::find($id);
        $Rules = [];
        $Messages = [];
        if(empty($medcin))
            return response()->json(['status'=>'NotOk']);
        

        if($medcin->Nom != $request->input('Nom')){
            $Rules['Nom']='required|max:30|min:3|regex:/^[a-zA-Z0-9éèàç]+(([\',. -][a-zA-Z0-9éèàç ])?[0-9a-zA-Zéèàç]*)*$/i';
            $Messages = array_merge($Messages,[
                'Nom.required'  =>  " Saisissez Le nom. ",
            'Nom.max'  =>  " 30 caractères au Max. ",
            'Nom.min'  =>  " le nom est très court. ",
            'Nom.regex'  =>  " Le nom saisi est invalide. ",
            ]);
            $medcin->Nom = $request->input('Nom');
        }


        if($medcin->Prenom != $request->input('Prenom')){
            $Rules['Prenom']='required|max:30|min:3|regex:/^[a-zA-Z0-9éèàç]+(([\',. -][a-zA-Z0-9éèàç ])?[0-9a-zA-Zéèàç]*)*$/i';
            $Messages = array_merge($Messages,[
                'Prenom.required'  =>  " Saisissez Le prenom. ",
                'Prenom.max'  =>  " 30 caractères au Max. ",
                'Prenom.min'  =>  " le prenom est très court. ",
                'Prenom.regex'  =>  " Le prenom saisi est invalide. ",
            ]);
            $medcin->Prenom = $request->input('Prenom');
        }

        
        if($medcin->Specialite != $request->input('Specialite')){
            $Rules['Specialite']= 'required|min:2|regex:/^[a-zA-Z0-9éèàç]+(([\',. -][a-zA-Z0-9éèàç ])?[0-9a-zA-Zéèàç]*)*$/i';
            $Messages = array_merge($Messages,[
                'Specialite.required'   =>  ' Entrez une spécialité ',
                'Specialite.regex'   =>  ' Caractères non alloués ',
                'Specialite.min'   =>  ' données invalides ',
            ]);
            $medcin->Specialite = $request->input('Specialite');
        }


        if($medcin->Email != $request->input('Email')){
            $Rules['Email']= 'required|email|max:100|unique:secretaires|unique:medcins|unique:cabinets,AdminEmail';
            $Messages = array_merge($Messages,[
                'Email.required'  =>  " Saisissez L'adresse Email ",
                'Email.email'  =>  " Adresse Email invalide ",
                'Email.max'  =>  " Maximum est de 100 caractères. ",
                'Email.unique'  =>  " Adresse Déjà enregistré pour un utilisateur. ",
            ]);
            $medcin->Email = $request->input('Email');
        }


        if($medcin->Pseudo != $request->input('Pseudo')){
            $Rules['Pseudo']= 'required|max:20|min:3|alpha_num|unique:medcins';
            $Messages = array_merge($Messages,[
                'Pseudo.required'  =>  " Saisissez un Pseudo-nom ",
                'Pseudo.max'  =>  " 20caractères au Max.",
                'Pseudo.min'  =>  " Pseudo-nom invalide. ",
                'Pseudo.alpha_num'  =>  " Pseudo-nom invalide. ",
                'Pseudo.unique'  =>  " Pseudo-nom déjà enregistré pour un utilisateur. ",
            ]);
            $medcin->Pseudo = $request->input('Pseudo');
        }


        if( !empty($request->input('password')) && !Hash::check( $request->input('password'),$medcin->password )){
            $Rules['password']= 'required|min:6';
            $Messages = array_merge($Messages,[
                'password.required' =>  " Saisissez un mot de passe ",
                'password.min' =>  " Le Mot de passe Est de 6 caractères au Min ",
            ]);
            $medcin->password = Hash::make( $request->input('password') );
        }

        
        if($medcin->Tel != $request->input('Tel')){
                    $Rules['Tel']=  'required|min:9|max:14|regex:/^[0-9+\- ]*$/i';
                    $Messages = array_merge($Messages,[
                        'Tel.required' =>  " Entrez le Numéro de Téléphone ",
                        'Tel.min' =>  " Numéro de Téléphone invalide ",
                        'Tel.max' =>  " Numéro de Téléphone invalide ",
                        'Tel.regex' =>  " Numéro de Téléphone invalide ",
                    ]);
                    $medcin->Tel = $request->input('Tel');
        }

        if($medcin->Adresse != $request->input('Adresse')){
            $Rules['Adresse']= 'nullable|max:100';

            $Messages = array_merge($Messages,[
                'Adresse.max' =>  " 100 Caractères au Max. ",
            ]);
            $medcin->Adresse = $request->input('Adresse');
        }


        $this->validate(
            $request,
            $Rules,
            $Messages
        );

        $res = $medcin->update();
        if($res){
            return response()->json(['status'=>'OK']);
        }else{
            return response()->json(['status'=>'NotOk']);
        }
    }

    public function Delete(Request $request){

        $id= $request->input('deleteID');
        $medcin = Medcin::find($id);
        if(empty($medcin))
            return response()->json(['status'=>'NotOk']);
        
        $this->validate(
            $request,
            [
                'password'  =>  'required|min:6'
            ],
            [
                'password.required' =>  " Saisissez votre mot de passe ",
                'password.min' =>  " Mot de passe erroné ",
            ]
        );

        $admin = Cabinet::first();

        if( !Hash::check($request->input('password'), $admin->password ) )
            return response()->json(['status'=>'pwd']);

        $res = $medcin->delete();
        if($res){
            return response()->json(['status'=>'OK']);
        }else{
            return response()->json(['status'=>'NotOk']);
        }

    }

    public function Account_Settings(){
        $name= Auth::guard('medcin')->user()->Nom.' '.Auth::guard('medcin')->user()->Prenom;
        $user = Auth::guard('medcin')->user();
        return view('Medcin.AccountSettings')->with(['name'=>$name,'LastLoginDate'=>$user->DernierLog,'user'=>$user]);
    }


}