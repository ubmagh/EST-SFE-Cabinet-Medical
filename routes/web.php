<?php

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
    return view('Home');
});


Route::get('/login/Secretaire',function(){ 
    return view('login.Secretaire');
});

Route::post('/login/Secretaire','SecretaireController@CheckLogin');

Route::get('/login/Medcin',function(){ 
    return view('login.Medcin');
});

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/test', function () {
    return view('dachboard.index');
});