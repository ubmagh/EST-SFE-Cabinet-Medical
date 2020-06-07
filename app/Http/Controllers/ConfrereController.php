<?php

namespace App\Http\Controllers;

use App\confrere;

use Illuminate\Validation\Rule;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ConfrereController extends Controller
{
    //

    public function index(Request $request){
        $user = Auth::guard('secretaire')->user();
        $confrere = confrere::OrderBy('date_ajout','ASC')->get();
        return view('Secretaire.Confreres.index',['name'=>$user->Nom.' '.$user->Prenom, 'confrere'=>$confrere,'counter'=>1]);
    }

    public function store(Request $request){

        $this->validate($request,
        [
            'Nom'   =>  'required|string|max:60',
            'Tel'   =>  'nullable|string|max:14|min:9|regex:/^[0-9+\- ]*$/i',
            'Fax'   =>  'nullable|string|max:14|min:9|regex:/^[0-9+\- ]*$/i',
            'Email'   =>  'nullable|string|max:90|email',
            'adresse'   =>  'required|string|max:50',
            'Ville'   =>    'required|string|max:40',
            'Specialite'   =>   'required|string|max:50',
        ],
        [
            'Nom.required'  =>  'Saissez le Nom du Confrère',
            'Nom.string'  =>  'saisie Invalide pour ce champ',
            'Nom.max'  =>  'le maximum pour ce champ est 60 caractères',
            'Tel.string'  =>  'saisie Invalide pour ce champ',
            'Tel.max'  =>  ' Numéro de tel invalide ',
            'Tel.min'  =>  ' Numéro de tel invalide ',
            'Tel.regex'  =>  ' Numéro de tel invalide ',
            'Fax.string'  =>  'saisie Invalide pour ce champ',
            'Fax.max'  =>  ' Numéro de fax invalide ',
            'Fax.regex'  =>  ' Numéro de fax invalide ',
            'Fax.min'  =>  ' Numéro de fax invalide ',
            'Email.string'  =>  'saisie invalide pour ce champ',
            'Email.max'  =>  'Email trop long',
            'Email.email'  =>  ' Adresse Email invalide ',
            'adresse.required'  =>  'saissez l\'adresse du confrère',
            'adresse.string'  =>  'saisie invalide pour ce champ',
            'adresse.max'  =>  'le maximum pour ce champ est 50 caractères',
            'Ville.required'  => 'champ obligatoir',
            'Ville.string'  => 'saisie invalide pour ce champ',
            'Ville.max'  =>  'le maximum pour ce champ est 40 caractères',
            'Specialite.max'  =>  'le maximum pour ce champ est 50 caractères',
            'Specialite.required'  => 'champ obligatoir',
            'Specialite.string'  =>  'saisie invalide pour ce champ',
        ]); 

        $confrere = new confrere();

        $confrere->Nom = $request->input('Nom') ;
        $confrere->Tel = $request->input('Tel')? $request->input('Tel'):null ;
        $confrere->Fax = $request->input('Fax')? $request->input('Fax'):null;
        $confrere->Email = $request->input('Email')? $request->input('Email'):null;
        $confrere->adresse = $request->input('adresse');
        $confrere->Ville = $request->input('Ville');
        $confrere->Specialite = $request->input('Specialite');

        $res = $confrere->save();
        
        if($res)
            return response()->json(['statut'=>'Good']);
        return response()->json(['statut'=>'Err']);
    }

    public function update(Request $request, $id){

        $this->validate($request,
        [   
            'id_confrere'    =>  ['required','exists:confreres,id', Rule::In([$id]) ],
            'Nom'   =>  'required|string|max:60',
            'Tel'   =>  'nullable|string|max:14|min:9|regex:/^[0-9+\- ]*$/i',
            'Fax'   =>  'nullable|string|max:14|min:9|regex:/^[0-9+\- ]*$/i',
            'Email'   =>  'nullable|string|max:90|email',
            'adresse'   =>  'required|string|max:50',
            'Ville'   =>    'required|string|max:40',
            'Specialite'   =>   'required|string|max:50',
        ],
        [
            'id_confrere.required'  =>  'xr',
            'id_confrere.in'  =>  'xs',
            'id_confrere.exists'  =>  'xe',
            'Nom.required'  =>  'Saissez le Nom du Confrère',
            'Nom.string'  =>  'saisie Invalide pour ce champ',
            'Nom.max'  =>  'le maximum pour ce champ est 60 caractères',
            'Tel.string'  =>  'saisie Invalide pour ce champ',
            'Tel.max'  =>  ' Numéro de tel invalide ',
            'Tel.min'  =>  ' Numéro de tel invalide ',
            'Tel.regex'  =>  ' Numéro de tel invalide ',
            'Fax.string'  =>  'saisie Invalide pour ce champ',
            'Fax.max'  =>  ' Numéro de fax invalide ',
            'Fax.regex'  =>  ' Numéro de fax invalide ',
            'Fax.min'  =>  ' Numéro de fax invalide ',
            'Email.string'  =>  'saisie invalide pour ce champ',
            'Email.max'  =>  'Email trop long',
            'Email.email'  =>  ' Adresse Email invalide ',
            'adresse.required'  =>  'saissez l\'adresse du confrère',
            'adresse.string'  =>  'saisie invalide pour ce champ',
            'adresse.max'  =>  'le maximum pour ce champ est 50 caractères',
            'Ville.required'  => 'champ obligatoir',
            'Ville.string'  => 'saisie invalide pour ce champ',
            'Ville.max'  =>  'le maximum pour ce champ est 40 caractères',
            'Specialite.max'  =>  'le maximum pour ce champ est 50 caractères',
            'Specialite.required'  => 'champ obligatoir',
            'Specialite.string'  =>  'saisie invalide pour ce champ',
        ]);
        $confrere = confrere::find($id);

        $confrere->Nom = $request->input('Nom');
        $confrere->Tel = $request->input('Tel');
        $confrere->Fax = $request->input('Fax');
        $confrere->Email = $request->input('Email');
        $confrere->adresse = $request->input('adresse');
        $confrere->Ville = $request->input('Ville');
        $confrere->Specialite = $request->input('Specialite');
        
        $res = $confrere->save();

        if($res)
            return response()->json(['statut'=>'Good']);
        return response()->json(['statut'=>'Err']);
    }

    public function destroy($Deletedid){

        $confrere = confrere::findOrFail($Deletedid);
        $confrere->delete();
    
    }

}