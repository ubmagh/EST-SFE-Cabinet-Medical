<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Operations_Cabinet;

class OperationsCabinetController extends Controller
{
    
    //


    public function index(){
        $Operations = Operations_Cabinet::all();
        return view('Admin.Operations.index', ['name'=>"Administrateur",'Operations'=>$Operations,'counter'=>0] );
    }

    public function store(Request $request){

        $this->validate($request,
        [
            'Intitule'  =>  'required|string|max:120',
            'Prix'  =>  'required|string|regex:/^\d+(.\d{1,2})?$/i|max:15',
            'Description'   =>  'nullable|string|max:320'
        ],
        [
            'Intitule.required'  =>  'Saisissez un Intitulé',
            'Intitule.string'  =>  'Données saisies sont invalides !',
            'Intitule.max'  =>  'le champ Intitulé est de 120 caractères au Max',
            'Prix.required'  =>  'Saisissez le Prix',
            'Prix.string'  =>  'Données saisies sont invalides !',
            'Prix.regex'  =>  'Données saisies sont invalides !',
            'Prix.max'  =>  ' prix trop long  !',
            'Description.string'  =>  'Données saisies sont invalides !',
            'Description.max'  =>  ' Maximum est 350 caractères',
        ]);

        $operationObj = new Operations_Cabinet();
        $operationObj->Intitule = $request->input('Intitule');
        $operationObj->Prix = doubleval( $request->input('Prix') );
        $operationObj->Description = strlen($request->input('Description'))>0? $request->input('Description'):null;
        $res = $operationObj->save();
        
        if( $res )
            return response()->json(['status'=>'OK']);
        return response()->json(['status'=>'err']);
    }

    public function update(Request $request, $id){

        $this->validate($request,
        [
            'id'    =>  'required|exists:operations__cabinets',
            'Intitule'  =>  'required|string|max:120',
            'Prix'  =>  'required|string|regex:/^\d+(.\d{1,2})?$/i|max:15',
            'Description'   =>  'nullable|string|max:320'
        ],
        [
            'id.required'   =>  "Données invalides Veuillez actualiser la page",
            'id.exists'   =>  "Données invalides Veuillez actualiser la page",
            'Intitule.required'  =>  'Saisissez un Intitulé',
            'Intitule.string'  =>  'Données saisies sont invalides !',
            'Intitule.max'  =>  'le champ Intitulé est de 120 caractères au Max',
            'Prix.required'  =>  'Saisissez le Prix',
            'Prix.string'  =>  'Données saisies sont invalides !',
            'Prix.regex'  =>  'Données saisies sont invalides !',
            'Prix.max'  =>  ' prix trop long  !',
            'Description.string'  =>  'Données saisies sont invalides !',
            'Description.max'  =>  ' Maximum est 350 caractères',
        ]);

        $operationObj = Operations_Cabinet::find($id) ;
        $operationObj->Intitule = $request->input('Intitule');
        $operationObj->Prix = doubleval( $request->input('Prix') );
        $operationObj->Description = strlen($request->input('Description'))>0? $request->input('Description'):null;
        $res = $operationObj->update();

        if( $res )
            return response()->json(['status'=>'OK']);
        return response()->json(['status'=>'err']);
    }

    public function destroy(Request $request, $id){

        $operationObj = Operations_Cabinet::findOrFail($id) ;
        $res = $operationObj->delete();
        if( $res )
            return response()->json(['status'=>'OK']);
        return response()->json(['status'=>'err']);
    }

    
    

}
