<?php

namespace App\Http\Controllers;

use App\Secretaire;
use Dotenv\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class SecretaireController extends Controller
{
    //


    
    public function index()
    {
        return view('secretaire'); // secretaire dashboard
    }

    
    public function Admin_Get_users_list(){
        $secretaires = Secretaire::all();
        return view('Admin.Users.Secretaires.list')->with(['name'=>"Administrateur",'secretaires'=>$secretaires,'counter'=>0]);
    }

    public function Create(Request $request){

        $this->validate($request,
        [
            'Nom'   =>  'required|max:30|min:3|regex:/^[a-zA-Z0-9éèàç]+(([\',. -][a-zA-Z0-9éèàç ])?[0-9a-zA-Zéèàç]*)*$/i',
            'Prenom'   =>  'required|max:30|min:3|regex:/^[a-zA-Z0-9éèàç]+(([\',. -][a-zA-Z0-9éèàç ])?[0-9a-zA-Zéèàç]*)*$/i',
            'Email'   =>  'required|email|max:100|unique:secretaires|unique:medcins|unique:cabinets,AdminEmail',
            'Pseudo'   =>  'required|max:20|min:3|alpha_num|unique:secretaires',
            'password'   =>  'required|min:6',
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
        ]);

        $res = Secretaire::create([
            'Nom'   =>  $request->input('Nom'), 
            'Prenom' =>  $request->input('Prenom'),
            'Email' =>  $request->input('Email'),
            'Pseudo' =>  $request->input('Pseudo'),
            'password' =>  Hash::make($request->input('password')),
            'Tel' =>  $request->input('Tel'),
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


}