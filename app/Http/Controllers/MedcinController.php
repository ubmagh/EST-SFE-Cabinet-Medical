<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MedcinController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth:medcin');
    }
   
    public function index()
    {
        return view('medcin'); /// medcin dashboard
    }
}