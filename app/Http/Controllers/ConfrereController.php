<?php

namespace App\Http\Controllers;

use App\confrere;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ConfrereController extends Controller
{
    //

    public function index(Request $request){
        $user = Auth::guard('secretaire')->user();
        $confrere = confrere::all();
        return view('Secretaire.Confreres.index',['name'=>$user->Nom.' '.$user->Prenom, 'confrere'=>$confrere]);
    }

    public function store(Request $request){
        $confrere = new confrere();

        $confrere->Nom = $request->input('Nom');
        $confrere->Prenom = $request->input('Prenom');
        $confrere->Tel = $request->input('Tel');
        $confrere->Fax = $request->input('Fax');
        $confrere->Email = $request->input('Email');
        $confrere->adresse = $request->input('adresse');
        $confrere->Ville = $request->input('Ville');
        $confrere->Specialite = $request->input('Specialite');

        $confrere->save();

    }

    public function update(Request $request, $id){
        $confrere = confrere::find($id);

        $confrere->Nom = $request->input('Nom');
        $confrere->Prenom = $request->input('Prenom');
        $confrere->Tel = $request->input('Tel');
        $confrere->Fax = $request->input('Fax');
        $confrere->Email = $request->input('Email');
        $confrere->adresse = $request->input('adresse');
        $confrere->Ville = $request->input('Ville');
        $confrere->Specialite = $request->input('Specialite');
        
        $confrere->save();

    }

    public function destroy($Deletedid){

        $confrere = confrere::find($Deletedid);
        $confrere->delete();
    
    }

}