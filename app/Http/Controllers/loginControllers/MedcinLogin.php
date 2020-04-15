<?php

namespace App\Http\Controllers\loginControllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\AuthenticatesUsers;


class MedcinLogin extends Controller
{
    //

    /// where to redirecte after login
    protected $redirectTo = '/';

    public function __construct()
    {
        $this->middleware('guest:medcin')->except('logout');
    }

    /**
     * Show the application’s login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLoginForm()
    {
        return view('Medcin.login');
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
        if(Auth::guard('medcin')->attempt($user_creds,$saveLogin)){
            Auth::shouldUse('medcin');
            return redirect('/');
        }else{
            return back()->with('error', 'Pseudo ou mot de passe est erroné .');
        }

    }
    

    protected function guard()
    {
        return Auth::guard('medcin');
    }

    public function username()
    {
        return 'Pseudo';
    }

    function logout()
    {
        Auth::guard('medcin')->logout();
        return redirect('/');
    }
  
}