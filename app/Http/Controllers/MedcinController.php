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
            'Prix'  =>  'required|min:0|regex:/^\d+(\.\d{1,2})?$/i',
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
            'Prix.required' =>  " Entrez le Prix de consultation ",
            'Prix.min' =>  " Prix invalide ! ",
            'Prix.regex' =>  " Prix invalide! ",
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
            'PrixDeConsultation'    =>  doubleval($request->input('Prix')),
            'remember_token'    =>  null,
            'created_at'    =>  date('Y-m-d H:i:s')
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
        
        if($medcin->PrixDeConsultation != $request->input('Prix')){
                    $Rules['Prix']=  'required|min:0|regex:/^\d+(\.\d{1,2})?$/i';
                    $Messages = array_merge($Messages,[
                        'Prix.required' =>  " Entrez le Prix de consultation ",
                        'Prix.min' =>  " Prix invalide ! ",
                        'Prix.regex' =>  " Prix invalide! ",
                    ]);
                    $medcin->PrixDeConsultation = doubleval($request->input('Prix')) ;
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


    public function Account_Settings_change(Request $request){

        $toDelete = $request->input('DelCurrent')?true:false;
        
        $this->validate(
            $request,
            [
                'Pseudo'    =>  'nullable|min:4|max:20|alpha_num|unique:secretaires',
                'Email' =>  'nullable|email|unique:medcins|unique:medcins|unique:cabinets,AdminEmail',
                'password'  =>  'nullable|min:6|max:100',
                'pwdc'  =>  'required_with:password|same:password',
                'Tel'   =>  'nullable|max:14|min:10||regex:/^[0-9+\- ]*$/i',
                'adresse'  =>  'nullable|max:100',
                'Nsigna'    =>  'nullable|file|image|mimes:jpeg,png,jpg,bmp|dimensions:min_width=300,min_height=100',
                'Oldpwd'    =>  'required_with:Pseudo,Email,password,Tel,adresse,Nsigna|password:medcin'
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
                'Nsigna.file'  =>  ' Fichier attendue! ',
                'Nsigna.image'  =>  ' Format du fichier est inconnue. ',
                'Nsigna.dimensions' =>  ' Les dimensions doivent etre au minimum 300*100px ',
                'Oldpwd.password'   =>  'Mot de passe incorrecte.'
            ]
        );

        
        $medcinUser = Medcin::find(Auth::guard('medcin')->user()->id);
        if(empty($medcinUser))
        return redirect()->back()->with('status','err');
        
        if( $request->input('Pseudo') )
            $medcinUser->Pseudo=$request->input('Pseudo');


        if( $request->input('Email') )
            $medcinUser->Email=$request->input('Email');


        if( $request->input('password') )
            $medcinUser->password= Hash::make( $request->input('password') );

        if( $request->input('Tel') )
            $medcinUser->Tel=$request->input('Tel');
        
        if( $request->input('adresse') )
            $medcinUser->Adresse=$request->input('adresse');

        
        $oldname = $medcinUser->Signature;

        if($request->Nsigna){
            $imageName = $medcinUser->id.'.'.$request->Nsigna->getClientOriginalExtension();
            request()->Nsigna->move( config('filesystems.disks.Signatures.root'), $imageName);
            $medcinUser->Signature = $imageName;
            if($oldname!=null)
                unlink(config('filesystems.disks.Signatures.root') . DIRECTORY_SEPARATOR.$oldname);
        }

        if($toDelete&&$oldname){
        $medcinUser->Signature = null;
        unlink(config('filesystems.disks.Signatures.root') . DIRECTORY_SEPARATOR.$oldname);
        }

        $res = $medcinUser->update();
        if($res)
            return redirect()->back()->with('status','done');
        return redirect()->back()->with('status','err');
    }


}