<?php

namespace App\Http\Controllers\loginControllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;


class SecretaireLogin extends Controller
{
    //



    /// where to redirecte after login
    protected $redirectTo = '/';

    public function __construct()
    {
            $this->middleware('guest')->except('logout');
            $this->middleware('guest:secretaire')->except('logout');
    }

    /**
     * Show the application’s login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLoginForm()
    {
        return view('login.Secretaire');
    }

    public function CheckLogin(Request $request){
        
        $saveLogin = !empty($request->saveMe);

        $messages = array(
            'pseudo.required' =>  'Saisissez votre Pseudo !',
            'pseudo.max'  =>  'Pseudo invalide',
            'pseudo.min'  =>  'Pseudo invalide',
            'pseudo.alpha_num'  =>  'Pseudo invalide',
            'password.required'  =>  'Entrez le mot de passe',
            'password.min'  =>  'mot de passe ou Pseudo incorrecte',
        );

        $this->validate($request,[
            'pseudo' =>  'required|alpha_num|max:15|min:5',
            'password'  =>  'required|min:6'
        ],$messages
        );
        $user_creds = array(
            'Pseudo'  =>  $request->input('pseudo'),
            'password'  =>  $request->input('password')
        );
        if(Auth::guard('secretaire')->attempt($user_creds,$saveLogin)){
            return redirect('main/successlogin');
        }else{
            return back()->with('error', 'Pseudo ou mot de passe est erroné .');
        }

    }
    
    function logout()
    {
     Auth::logout();
     return redirect('main');
    }
  
}