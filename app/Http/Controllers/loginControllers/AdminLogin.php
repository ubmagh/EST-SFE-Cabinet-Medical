<?php

namespace App\Http\Controllers\loginControllers;

use App\Cabinet;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminLogin extends Controller
{
    
    //
    protected $redirectTo = '/';

    
    public function __construct()
    {
        //Auth::guard('admin')->logout();
        $this->middleware('guest:admin')->except('logout');
    }

    /**
     * Show the application’s login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLoginForm()
    {
        return view('Admin.login');
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
            'AdminPseudo'  =>  $request->input('pseudo'),
            'password'  =>  $request->input('password')
        );
        if( Auth::guard('admin')->attempt($user_creds,$saveLogin) ){
            $now = date('Y-m-d H:i:s');
            // Last Login feature
            $admin = Cabinet::Find( Auth::guard('admin')->user()->id );
            $AdminLastLogin = json_decode( $admin->AdminLastLogin ); 
            $AdminLastLogin->last = $AdminLastLogin->first;
            $AdminLastLogin->first = $now;
            Auth::guard('admin')->user()->DernierLog="".json_encode(['last'=>$AdminLastLogin->last, 'first'=> $AdminLastLogin->first]);
            $admin->AdminLastLogin = json_encode(['last'=>$AdminLastLogin->last, 'first'=> $AdminLastLogin->first]);
            $admin->save();
            
            Auth::shouldUse('admin');
            
            return redirect('/');
        }else{
            return back()->with('error', 'Pseudo ou mot de passe est erroné .');
        }

    }

    protected function guard()
    {
        return Auth::guard('admin');
    }

    public function username()
    {
        return 'AdminPseudo';
    }

    function logout()
    {
        Auth::guard('admin')->logout();
        return redirect('/');
    }
    

}