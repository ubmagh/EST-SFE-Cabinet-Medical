<?php

namespace App\Http\Controllers;

use App\Medicament;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class MedicamentController extends Controller
{
    //

    public function Index(Request $request){

        $name= Auth::guard('secretaire')->user()->Nom.' '.Auth::guard('secretaire')->user()->Prenom;
        $medicaments = Medicament::all()->toArray();
        
        return view('Secretaire.Medicaments.index',['name'=>$name,'medicaments'=>$medicaments,'counter'=>0]);
    }

    public function create(Request $request){

        $messages = array(
            'Nom.required' =>  'Saisissez le nom svp !',
            'Nom.max'  =>  'Nom trop long',
            'Nom.min'  =>  'Nom trop court',
            'Nom.regex'  =>  'Nom invalide',
            'Prise.regex'  =>  'Caractères invalides',
            'Prise.max'  =>  '30 caractères au MAX',
            'Quand.in'  =>  'Choix invalide',
            'Quand.required'  =>  'Choix invalide',
            
        );

        $this->validate($request,[
            'Nom' =>  'required|regex:/^[a-zA-Z0-9 ]+(([\',. -][a-zA-Z0-9 ])?[a-zA-Z0-9]*)*$/i|max:160|min:2',
            'Prise' =>  'max:30|regex:/^[a-zA-Z0-9 ]+(([\',. -][a-zA-Z0-9 ])?[a-zA-Z0-9]*)*$/i|nullable',
            'Quand' =>  ['required',Rule::in(['Avant','Apres','indifini'])]
        ],$messages
        );


        $res = Medicament::create([
            'Nom'   =>  $request->input('Nom'), 
            'Prise' =>  $request->input('Prise'),
            'Quand' =>  $request->input('Quand')
        ]);

        if($res){
            return response()->json(['status'=>'OK']);
        }else{
            return response()->json(['status'=>'NotOk']);
        }
    }

    public function update(Request $request,$id){

        $messages = array(
            'Nom.required' =>  'Saisissez le nom svp !',
            'Nom.max'  =>  'Nom trop long',
            'Nom.min'  =>  'Nom trop court',
            'Nom.regex'  =>  'Nom invalide',
            'Prise.regex'  =>  'Caractères invalides',
            'Prise.max'  =>  '30 caractères au MAX',
            'Quand.in'  =>  'Choix invalide',
            'Quand.required'  =>  'Choix invalide',
            
        );

        $this->validate($request,[
            'Nom' =>  'required|regex:/^[a-zA-Z0-9 ]+(([\',. -][a-zA-Z0-9 ])?[a-zA-Z0-9]*)*$/i|max:160|min:2',
            'Prise' =>  'max:30|regex:/^[a-zA-Z0-9 ]+(([\',. -][a-zA-Z0-9 ])?[a-zA-Z0-9]*)*$/i|nullable',
            'Quand' =>  ['required',Rule::in(['Avant','Apres','indifini'])]
        ],$messages
        );


        $medicament = Medicament::Find($id);
        if(empty($medicament)|| !$medicament)
            return response()->json(['status'=>'NotOk']);
        $medicament->Nom   =  $request->input('Nom');
        $medicament->Prise =  $request->input('Prise');
        $medicament->Quand =  $request->input('Quand');

        if(  $medicament->save() )
            return response()->json(['status'=>'OK']);
            return response()->json(['status'=>'NotOk']);

    }

    public function destroy(Request $request,$id){
        $medicament = Medicament::Find($id);
        if(empty($medicament)|| !$medicament)
            return response()->json(['status'=>'NotOk']);

        if(  $medicament->delete() )
            return response()->json(['status'=>'OK']);
            return response()->json(['status'=>'NotOk']);
    }

}