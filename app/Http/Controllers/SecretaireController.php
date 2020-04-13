<?php

namespace App\Http\Controllers;
use Dotenv\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SecretaireController extends Controller
{
    //


    
    public function index()
    {
        return view('secretaire'); // secretaire dashboard
    }

    



}