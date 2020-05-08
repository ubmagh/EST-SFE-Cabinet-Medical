<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

}