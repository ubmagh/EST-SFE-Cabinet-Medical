<?php

namespace App\Http\Controllers;

use App\Cabinet;
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
        return view('Admin.UsersGestion.Secretaires.index')->with(['name'=>"Administrateur",'secretaires'=>$secretaires,'counter'=>0]);
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
            'password.required' =>  " Saisissez un mot de passe ",
            'password.min' =>  " Le Mot de passe Est de 6 caractères au Min ",
            'Tel.required' =>  " Entrez le Numéro de Téléphone ",
            'Tel.min' =>  " Numéro de Téléphone invalide ",
            'Tel.max' =>  " Numéro de Téléphone invalide ",
            'Tel.regex' =>  " Numéro de Téléphone invalide ",
            'Adresse.max' =>  " 100 Caractères au Max. ",
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



    public function Update(Request $request){

        $id= $request->input('id');
        $secretaire = Secretaire::find($id);
        $Rules = [];
        $Messages = [];
        if(empty($secretaire))
            return response()->json(['status'=>'NotOk']);
        

        if($secretaire->Nom != $request->input('Nom')){
            $Rules['Nom']='required|max:30|min:3|regex:/^[a-zA-Z0-9éèàç]+(([\',. -][a-zA-Z0-9éèàç ])?[0-9a-zA-Zéèàç]*)*$/i';
            $Messages = array_merge($Messages,[
                'Nom.required'  =>  " Saisissez Le nom. ",
            'Nom.max'  =>  " 30 caractères au Max. ",
            'Nom.min'  =>  " le nom est très court. ",
            'Nom.regex'  =>  " Le nom saisi est invalide. ",
            ]);
            $secretaire->Nom = $request->input('Nom');
        }


        if($secretaire->Prenom != $request->input('Prenom')){
            $Rules['Prenom']='required|max:30|min:3|regex:/^[a-zA-Z0-9éèàç]+(([\',. -][a-zA-Z0-9éèàç ])?[0-9a-zA-Zéèàç]*)*$/i';
            $Messages = array_merge($Messages,[
                'Prenom.required'  =>  " Saisissez Le prenom. ",
                'Prenom.max'  =>  " 30 caractères au Max. ",
                'Prenom.min'  =>  " le prenom est très court. ",
                'Prenom.regex'  =>  " Le prenom saisi est invalide. ",
            ]);
            $secretaire->Prenom = $request->input('Prenom');
        }


        if($secretaire->Email != $request->input('Email')){
            $Rules['Email']= 'required|email|max:100|unique:secretaires|unique:medcins|unique:cabinets,AdminEmail';
            $Messages = array_merge($Messages,[
                'Email.required'  =>  " Saisissez L'adresse Email ",
                'Email.email'  =>  " Adresse Email invalide ",
                'Email.max'  =>  " Maximum est de 100 caractères. ",
                'Email.unique'  =>  " Adresse Déjà enregistré pour un utilisateur. ",
            ]);
            $secretaire->Email = $request->input('Email');
        }


        if($secretaire->Pseudo != $request->input('Pseudo')){
            $Rules['Pseudo']= 'required|max:20|min:3|alpha_num|unique:secretaires';
            $Messages = array_merge($Messages,[
                'Pseudo.required'  =>  " Saisissez un Pseudo-nom ",
                'Pseudo.max'  =>  " 20caractères au Max.",
                'Pseudo.min'  =>  " Pseudo-nom invalide. ",
                'Pseudo.alpha_num'  =>  " Pseudo-nom invalide. ",
                'Pseudo.unique'  =>  " Pseudo-nom déjà enregistré pour un utilisateur. ",
            ]);
            $secretaire->Pseudo = $request->input('Pseudo');
        }


        if( !empty($request->input('password')) && !Hash::check( $request->input('password'),$secretaire->password )){
            $Rules['password']= 'required|min:6';
            $Messages = array_merge($Messages,[
                'password.required' =>  " Saisissez un mot de passe ",
                'password.min' =>  " Le Mot de passe Est de 6 caractères au Min ",
            ]);
            $secretaire->password = Hash::make( $request->input('password') );
        }

        
        if($secretaire->Tel != $request->input('Tel')){
                    $Rules['Tel']=  'required|min:9|max:14|regex:/^[0-9+\- ]*$/i';
                    $Messages = array_merge($Messages,[
                        'Tel.required' =>  " Entrez le Numéro de Téléphone ",
                        'Tel.min' =>  " Numéro de Téléphone invalide ",
                        'Tel.max' =>  " Numéro de Téléphone invalide ",
                        'Tel.regex' =>  " Numéro de Téléphone invalide ",
                    ]);
                    $secretaire->Tel = $request->input('Tel');
        }

        if($secretaire->Adresse != $request->input('Adresse')){
            $Rules['Adresse']= 'nullable|max:100';

            $Messages = array_merge($Messages,[
                'Adresse.max' =>  " 100 Caractères au Max. ",
            ]);
            $secretaire->Adresse = $request->input('Adresse');
        }


        $this->validate(
            $request,
            $Rules,
            $Messages
        );

        $res = $secretaire->update();
        if($res){
            return response()->json(['status'=>'OK']);
        }else{
            return response()->json(['status'=>'NotOk']);
        }
    }



    public function Delete(Request $request){

        $id= $request->input('deleteID');
        $secretaire = Secretaire::find($id);
        if(empty($secretaire))
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

        $res = $secretaire->delete();
        if($res){
            return response()->json(['status'=>'OK']);
        }else{
            return response()->json(['status'=>'NotOk']);
        }

    }

    
    
    public function Account_Settings(){
        $name= Auth::guard('secretaire')->user()->Nom.' '.Auth::guard('secretaire')->user()->Prenom;
        $user = Auth::guard('secretaire')->user();
        return view('Secretaire.AccountSettings')->with(['name'=>$name,'LastLoginDate'=>$user->DernierLog,'user'=>$user]);
    }


    public function Account_Settings_change(Request $request){

        $this->validate(
            $request,
            [
                'Pseudo'    =>  'nullable|min:4|max:20|alpha_num|unique:secretaires',
                'Email' =>  'nullable|email|unique:medcins|unique:medcins|unique:cabinets,AdminEmail',
                'password'  =>  'nullable|min:6|max:100',
                'pwdc'  =>  'required_with:password|same:password',
                'Tel'   =>  'nullable|max:14|min:10||regex:/^[0-9+\- ]*$/i',
                'adresse'  =>  'nullable|max:100',
                'Oldpwd'    =>  'required_with:Pseudo,Email,password,Tel,adresse|password:secretaire'
            ],
            [
                'Pseudo.min'    =>  'Pseudo doit etre de 4 caractères au Min.',
                'Pseudo.max'    =>  'Pseudo doit etre de 20 caractères au Max.',
                'Pseudo.alpha_num'  =>  'Pseudo invalide, contient des caractères non alloués.',
                'Email.email' => 'Adresse Email invalide',
                'Email.unique'  =>  'adresse Email est déjà enregistrée pour un utilisateur.',
                'password.min'  =>  'le mot de passe doit etre de 6 caractères au Min.',
                'password.max'  =>  'le mot de passe est trop long',
                'pwdc.required_with'    =>  'Saisissez d\'abord le nouveau mot de passe ',
                'pwdc.same' =>  ' Confirmation de mot de passe est erronée ',
                'Tel.max'   =>  'Numéro de téléphone est invalide .',
                'Tel.min'   =>  'Numéro de téléphone est invalide .',
                'Tel.regex'   =>  'Numéro de téléphone est invalide .',
                'adresse.max'   =>  'Maximum pour ce champs est de 100 caractères.',
                'Oldpwd.password'   =>  'Mot de passe incorrecte.'
            ]
        );

        
        $secretaireUser = Secretaire::find(Auth::guard('secretaire')->user()->id);
        if(empty($secretaireUser))
        return redirect()->back()->with('status','err');
        
        if( $request->input('Pseudo') )
            $secretaireUser->Pseudo=$request->input('Pseudo');


        if( $request->input('Email') )
            $secretaireUser->Email=$request->input('Email');


        if( $request->input('password') )
            $secretaireUser->password= Hash::make( $request->input('password') );

        if( $request->input('Tel') )
            $secretaireUser->Tel=$request->input('Tel');
        
        if( $request->input('adresse') )
            $secretaireUser->Adresse=$request->input('adresse');


        $res = $secretaireUser->update();
        if($res)
            return redirect()->back()->with('status','done');
        return redirect()->back()->with('status','err');
    }



}