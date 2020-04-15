<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/




// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/test', function () {
    return view('dachboard.index');
});






Route::get('/', function () {
    if( Auth::guard('secretaire')->check() ){
        $name= Auth::guard('secretaire')->user()->Nom.' '.Auth::guard('secretaire')->user()->Prenom;
        return view('secretaire.dashboard.index')->with('name',$name);
    }
    if( Auth::guard('medcin')->check() ){
        $name= Auth::guard('medcin')->user()->Nom.' '.Auth::guard('medcin')->user()->Prenom;
        return view('medcin.dashboard.index')->with('name',$name);
    }
    return view('Home');
})->name('Homepage');


/// Secretary login
Route::post('/Secretaire','loginControllers\SecretaireLogin@CheckLogin');

/// Medic login
Route::post('/Medcin','loginControllers\MedcinLogin@CheckLogin');



/// Login page for secretary member if already logged=> redirected to main page
Route::middleware(['guest:secretaire','guest:medcin'])->get('/Secretaire',function(){ 
    return view('Secretaire.login');
});


///  Forgotten username or password route for non member user, else is redirected to main page with middleware
Route::middleware(['guest:secretaire','guest:medcin'])->get('/Forgot',function(){
    return view('forgot');
});


/// Login page for medic member if already logged=> redirected to main page
Route::middleware(['guest:secretaire','guest:medcin'])->get('/Medcin',function(){ 
    return view('Medcin.login');
});



Route::get('/logout',function(){ 
    if( Auth::guard('secretaire')->check() )
        return app()->call('App\Http\Controllers\loginControllers\SecretaireLogin@logout');
    if( Auth::guard('medcin')->check() )
        return app()->call('App\Http\Controllers\loginControllers\MedcinLogin@logout');
    Auth::logout();
    return redirect('/');
});



Route::middleware('auth:secretaire')->get('Medicaments', function () {
    $name= Auth::guard('secretaire')->user()->Nom.' '.Auth::guard('secretaire')->user()->Prenom;
    return view('Secretaire.Medicaments.index',['name'=>$name]);
});