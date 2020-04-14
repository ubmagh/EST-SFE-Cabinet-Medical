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

Route::get('/', function () {
    if( Auth::guard('secretaire')->check() )
        return view('secretaire.dashboard.index');
    return view('Home');
})->name('Homepage');

Route::post('/Secretaire','loginControllers\SecretaireLogin@CheckLogin');



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
    Auth::guard('secretaire')->logout();
    return redirect('/');
});


// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/test', function () {
    return view('dachboard.index');
});



// ->middleware('auth:secretaire');