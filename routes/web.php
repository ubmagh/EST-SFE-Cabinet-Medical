<?php

use Carbon\Carbon;
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
    Route::resource('patient', 'PatientController');
    Route::get('/Rendez-Vous', function () {
        $name= Auth::guard('secretaire')->user()->Nom.' '.Auth::guard('secretaire')->user()->Prenom;
        return view('Secretaire.Rendezvous.index')->with('name', $name); // hadi ztha hit ntoma katreturniw le nom mea lview
         });
    Route::resource('/Rendez-Vous/Ressource' ,'RendezvousController');//hadi api kan2afichi biha rdv f calendar/insert rdv f calendar/
    Route::put('/Rendez-Vous/Update','RendezvousController@update');//update rdv f calendar
    Route::get('/Rendez-Vous/autocomplete','RendezvousController@autocomplete_rdv_patient');


    // Sale attente routes
    Route::resource('/SalleAttente' ,'SalleAttenteController');
    Route::post('/SalleAttente/Add' ,'SalleAttenteController@CreateWithoutRdv');
    Route::post('/SalleAttente_aprouveRdv/{id}','SalleAttenteController@CreateWithRdv');
    Route::get('/SalleAttente/UndoRdv/{id}','SalleAttenteController@UndoRdvConfirmation');
    Route::get('/SalleAttente/NextPatient/{id}','SalleAttenteController@GoNextPatient');
    Route::get('/SalleAttente/Urgent/{id}','SalleAttenteController@UrgentPatient');
    Route::get('/SalleAttente/UnUrgent/{id}','SalleAttenteController@UnUrgentPatient');
    Route::get('/SalleAttente/Quit/{id}','SalleAttenteController@QuitPatient');

    /// Paramètres de compte
    Route::get('SecretaireParametres', 'SecretaireController@Account_Settings');
    Route::post('SecretaireParametres', 'SecretaireController@Account_Settings_change');

    // Confreres routes
    Route::get('Confreres', 'ConfrereController@Secretaire_gestion_view');
    
    // Verifier l'etat du patient pour actualiser le panneau de secretaire
    Route::get('CheckPatientStatut', 'SalleAttenteController@check_patient_sec');

      // Confreres routes
      Route::resource('Confreres', 'ConfrereController');
});

#################################   Secretary Routes End   ################################





#-----------------------------------------------------------------------------------------#



#################################   Medcin Routes start   ################################



Route::group(['middleware' => ['auth:medcin']], function () {

    // Consultation Routes
    Route::resource('Consultation', 'ConsultationController');
    Route::get('Medicament/Search', 'MedicamentController@autocomplete_Medcin_Medica');
    Route::get('Examens/Example', 'ExamenController@ExamsNamesExamples');

    // lettre au confreres route
    Route::resource('LettreAuConfrere', 'LettreAuConfrereController'); // Crud
    Route::get('LettresAuConfreres', 'LettreAuConfrereController@GetListe');// list des lettres
    Route::get('LettreAuConfrerePatient','LettreAuConfrereController@autocomplete_patient');
    Route::get('Lettre/{id}','LettreAuConfrereController@printLetter'); // imprimer une lettre




    // Fiche Patient
    Route::get('FichePatient/{id}','PatientController@fichepourMedecin'); // imprimer une lettre
    

    /// Dossier Medical : /DossierMedical
    Route::get('DossierMedical','PatientController@DossierMedical_mainForSearch'); // imprimer une lettre


    // Ordonnance Route
    Route::get('/Ordonnance/{ordonnanceid}', 'OrdonnanceController@GetOrdonnancePDF');

    // Paramètres de compte
    Route::get('MedcinParametres', 'MedcinController@Account_Settings');
    Route::post('MedcinParametres', 'MedcinController@Account_Settings_change');

    // Lien vers la signature
    Route::get('/Signature/{filename}','SignatureController@getImage');

    // Check Consultation pipe / buffer :P
    Route::get('/CheckForConsultation','SalleAttenteController@checkSalle');

});





#################################   Medcin Routes End   ################################



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

    /// Paramètres de compte
    Route::get('AdminParametres', 'CabinetController@Admin_Account_Settings');
    Route::post('AdminParametres', 'CabinetController@Admin_Account_Settings_change');

    /// Gestion des Opérations de cabinet par l'admin
    Route::resource('Operations','OperationsCabinetController');

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