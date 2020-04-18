<?php

namespace App\Http\Controllers\loginControllers;

use App\Http\Controllers\Controller;
use App\Mail\CredsReset;
use App\Medcin;
use App\Secretaire;
use Illuminate\Http\Request;
use App\PasswordReset;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

use function GuzzleHttp\_current_time;

class ForgotController extends Controller
{
    //
    public function Attempt(Request $request){


    $messages = array(
        'email.required' =>  'Saisissez votre adresse email !',
        'email.email'  =>  'Email saisi est invalide !',
    );

    $this->validate($request,[
        'email' =>  'required|email',
    ],$messages
    );

    $email = $request->input('email');

    $user = Secretaire::where('Email',$email)->first();

    if(empty($user)){
        $user = Medcin::where('Email',$email)->first();
        if(empty($user))
            return redirect()->back()->with(["Eroor"=>"Compte introuvable pour l'email : ".$email." ."]);  
    }
    $token = Str::random(64);
    
    $passwordreset = PasswordReset::create([
        'email' =>  $email,
        'token' =>  $token,
        'created_at'    =>  Carbon::now()
    ]);
    
    $url = url('/Reset',$token)."?m=".urlencode($email);
    Mail::to('email@email.com')->send( new CredsReset($user->Pseudo,$url) );
    return redirect()->back()->with(['success'=>'done']);
    }


    public function reset(Request $request,$token){

        $email =  urldecode( $request->m);
        $validator =  Validator::make(['email'=>$email,'token'=>$token],
        ['email'=>'required|email', 'token'=>'required|min:64|max:64']
        );
        if($validator->fails())
            return view('errors.404');
        
        return view('PasswordReset.passwordReset',['res_Token'=>$token,'res_email'=>$email]);
    } 


    public function update(Request $request)
    {

        $this->validate($request,
        [
            'res_Token' =>  'required|min:64|max:64',
            'res_email' =>  'required|email',
            'password1'  =>  'required|min:6',
            'password2'  =>  [
                'required',
                Rule::in([$request->only('password1')]),
            ],
        ],
        [
            'res_Token.min'=>'x',
            'res_Token.required'=>'x',
            'res_Token.max'=>'x',
            'res_email.required'=>'x',
            'res_email.email'=>'x',
            'password1.required'=>'Saisissez votre nouveau Mot de passe.',
            'password1.min'=>'le nouveau mot de passe doit contenir au Min 6 caractères',
            'password2.required'=>'Confirmez votre nouveau Mot de passe.',
            'password2.in'=>' La Confirmation est erronnée .',
        ]
        );


        


    }


}