<?php

namespace App\Http\Controllers;

use App\Cabinet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rule;

class CabinetController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function Cabinet_Infos_View(Request $request){
        $cabinet = Auth::guard('admin')->user();
        return view('Admin.InfosDeCabinet.index')->with(['name'=>"Administrateur",'cabinet'=>$cabinet]);
    }


    public function Get_Edit_Form(){
        $cabinet = Auth::guard('admin')->user();
        return view('Admin.InfosDeCabinet.Modify')->with(['name'=>"Administrateur",'cabinet'=>$cabinet]);
    }


    public function SubmitChanges(Request $request){

        $this->validate($request,
        [
            'logodelete'    =>  Rule::in(['0','1']),
            'logo'   =>  'nullable|file|image|mimes:jpeg,png,jpg,svg,bmp|dimensions:min_width=200,min_height=200',
            'Nom'   =>  'max:100|regex:/^[a-zA-Z0-9éèàç]+(([\',. -][a-zA-Z0-9éèàç ])?[0-9a-zA-Zéèàç]*)*$/i',
            'Specialites'   =>  'nullable|max:255|regex:/^[a-zA-Z0-9éèàç]+(([\',. -][a-zA-Z0-9éèàç ])?[0-9a-zA-Zéèàç]*)*$/i',
            'Tel'   =>  'nullable|max:14|regex:/^[0-9+\- ]*$/i',
            'Fax'   =>  'nullable|max:14|regex:/^[0-9+\- ]*$/i',
            'Email'   =>  'nullable|max:180|email',
            'Adresse'   =>  'nullable|max:255',
            'Description'   =>  'nullable|max:255',
            'password'   =>  'min:6',
        ],
        [
            'logodelete.in' =>  'Données Fournies sont Invalides',
            'logo.file' =>  'Erreur de chargement de l\'image ',
            'logo.image' =>  ' Le fichier choisi n\'est pas une image ',
            'logo.mimes' =>  ' Type d\'image est non pris en charge ',
            'logo.dimensions' =>  ' l\'image doit etre au min 200*200px ',
            'Nom.max' =>  ' 100 caractères au Max ',
            'Nom.regex' =>  ' Le nom contient des Caractères invalides ',
            'Specialites.max' =>  ' 255 caractères au Max ',
            'Specialites.regex' =>  ' champ de Specialites contient des Caractères invalides ',
            'Tel.max' =>  ' Numéro de Téléphone invalide  ',
            'Tel.regex' =>  ' Numéro de Téléphone invalide  ',
            'Fax.max' =>  ' Numéro de Fax invalide  ',
            'Fax.regex' =>  ' Numéro de Fax invalide  ',
            'Email.max' =>  ' Adresse Email invalide  ',
            'Email.email' =>  ' Adresse Email invalide  ',
            'Adresse.max' =>  ' 255 caractères au Max ',
            'Description.max' =>  ' 255 caractères au Max ',
            'password.min' =>  ' Mot de Passe Invalide ',
        ]);
        
        $user = Auth::guard('admin')->user();
        
        if ( ! Hash::check($request->input('password'), $user->password) ) {
           return Redirect::back()->with('wrongPwd', 'Mot de passe erroné!');  
        }

        $CabinetOBj = Cabinet::first();
        
        if($request->input('logodelete').''=='1'){
            if($CabinetOBj->logo!='')
            unlink(public_path('\images\logo\\'.$CabinetOBj->logo));
        $CabinetOBj->logo='';
        }

        if( $request->input('Nom') ){
            $CabinetOBj->Nom=$request->input('Nom');
        }

        if( $request->input('Specialites') ){
            $CabinetOBj->Specialites=$request->input('Specialites');
        }
            
        if( $request->input('Tel') ){
            $CabinetOBj->Tel=$request->input('Tel');
        }

        if( $request->input('Fax') ){
            $CabinetOBj->Fax=$request->input('Fax');
        }

        if( $request->input('Email') ){
            $CabinetOBj->Email=$request->input('Email');
        }
        
        if( $request->input('Adresse') ){
            $CabinetOBj->Adresse=$request->input('Adresse');
        }
        
        if( $request->input('Description') ){
            $CabinetOBj->Description=$request->input('Description');
        }

        if($request->logo){
        $imageName = time().'.'.request()->logo->getClientOriginalExtension();
        $oldname = $user->logo;
        request()->logo->move(public_path('images/logo/'), $imageName);
        $CabinetOBj->logo = $imageName;
        if($oldname!='')
            unlink(public_path('\images\logo\\'.$oldname));
        }
        //update database
        $CabinetOBj->update();
        return redirect(url('/CabinetInfos'))->with('edited','success');
    }


}