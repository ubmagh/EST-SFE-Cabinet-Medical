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
    if( Auth::guard('admin')->check() ){
        return view('admin.dashboard.index')->with('name',"Administrateur");
    }
    return view('Home');
})->name('Homepage');





#################################   Login Routes   #################################

/// Secretary login
Route::post('/Secretaire','loginControllers\SecretaireLogin@CheckLogin');

/// Medic login
Route::post('/Medcin','loginControllers\MedcinLogin@CheckLogin');

/// admin login
Route::post('/admin','loginControllers\AdminLogin@CheckLogin');

Route::get('/logout',function(){ 
    if( Auth::guard('secretaire')->check() )
        return app()->call('App\Http\Controllers\loginControllers\SecretaireLogin@logout');
    if( Auth::guard('medcin')->check() )
        return app()->call('App\Http\Controllers\loginControllers\MedcinLogin@logout');
    if( Auth::guard('admin')->check() )
        return app()->call('App\Http\Controllers\loginControllers\AdminLogin@logout');
    Auth::logout();
    return redirect('/');
});
#################################   Login Routes End   ################################
#-----------------------------------------------------------------------------------------#





#################################   Secretary Routes   #################################

Route::group(['middleware' => ['auth:secretaire']], function () {
    //
    Route::resource('Medicaments', 'MedicamentController');
});

#################################   Secretary Routes End   ################################



#-----------------------------------------------------------------------------------------#



#################################   Admin Routes   #################################


Route::group(['middleware' => ['auth:admin']], function () {
    //
    Route::get('CabinetInfos', 'CabinetController@Cabinet_Infos_View');
    Route::get('CabinetInfos/Modify', 'CabinetController@Get_Edit_Form');
    Route::post('CabinetInfos', 'CabinetController@SubmitChanges');

    // Gestion des Secretaires
    Route::get('users/secretaires', 'SecretaireController@Admin_Get_users_list');
    Route::post('users/secretaires/create', 'SecretaireController@Create');
    Route::post('users/secretaires/Modify', 'SecretaireController@Update');
    Route::delete('users/secretaires/Delete', 'SecretaireController@Delete');
    
    // Gestion des Secretaires
    Route::get('users/medcins', 'MedcinController@Admin_Get_users_list');
    Route::post('users/medcins/create', 'MedcinController@Create');
    Route::post('users/medcins/Modify', 'MedcinController@Update');
    Route::delete('users/medcins/Delete', 'MedcinController@Delete');


});

#################################   Guest Routes End   ################################



#-----------------------------------------------------------------------------------------#




#################################   Guest Routes   #################################
/// etre non connecté pour y accéder

Route::group(['middleware' => ['guest:secretaire','guest:medcin','guest:admin']], function () {
    //
    
    /// Login page for medic member if already logged=> redirected to main page
    Route::get('/Medcin',function(){ 
        return view('Medcin.login');
    });

     /// Login page for secretary member if already logged=> redirected to main page
     Route::get('/Secretaire',function(){ 
        return view('Secretaire.login');
    });

    ///  Forgotten username or password route for non member user, else is redirected to main page with middleware
    Route::get('/Forgot',function(){
        return view('PasswordReset.forgot');
    });

    Route::post('/Forgot','loginControllers\ForgotController@Attempt');

    Route::get('/Reset/{token?}','loginControllers\ForgotController@reset');

    Route::post('/Reset','loginControllers\ForgotController@update');

    Route::get('/admin','loginControllers\AdminLogin@showLoginForm');

   
});

#################################   Guest Routes End   ################################