<?php

namespace App\Http\Controllers;

use App\Examen;
use Illuminate\Http\Request;

class ExamenController extends Controller
{
    //

    public function ExamsNamesExamples(Request $request){
        $data = Examen::select("Titre")
        ->orWhere("Titre","LIKE","%{$request->input('query')}%")
        ->get();
        return response()->json($data);
    }

}