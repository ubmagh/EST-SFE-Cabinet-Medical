<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CabinetController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function Cabinet_Infos_View(Request $request){
        return view('Admin.Infos.index')->with('name',"Administrateur");
    }

}