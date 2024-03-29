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



Route::get('/', function () {
    if( Auth::guard('secretaire')->check() ){

        $name= Auth::guard('secretaire')->user()->Nom.' '.Auth::guard('secretaire')->user()->Prenom;
        $nb_rdv=  app(\App\Http\Controllers\Dachboard\SecretaireController::class)->getNb_rdv();
        $nb_attente=  app(\App\Http\Controllers\Dachboard\SecretaireController::class)->getNb_attente();
        $nb_urgence=  app(\App\Http\Controllers\Dachboard\SecretaireController::class)->getNb_urgence();
        $nb_consultation=  app(\App\Http\Controllers\Dachboard\SecretaireController::class)->getNb_consultation();
        $rdv= app(\App\Http\Controllers\Dachboard\SecretaireController::class)->getListe_rdv();

        return view('Secretaire.dashboard.index' ,[  'name'        => $name ,
                                                      'nb_rdv'     => $nb_rdv,
                                                      'nb_attente' => $nb_attente,
                                                      'nb_urgence' => $nb_urgence,
                                                      'nb_consultation' => $nb_consultation,
                                                      'rdv' => $rdv
                                                 ]);
                                                 
    }
    if( Auth::guard('medcin')->check() ){
        
        $name= Auth::guard('medcin')->user()->Nom.' '.Auth::guard('medcin')->user()->Prenom;
        $nb_rdv=  app(\App\Http\Controllers\Dachboard\MedcinController::class)->getNb_rdv();
        $nb_attente=  app(\App\Http\Controllers\Dachboard\MedcinController::class)->getNb_attente();
        $nb_urgence=  app(\App\Http\Controllers\Dachboard\MedcinController::class)->getNb_urgence();
        $nb_consultation=  app(\App\Http\Controllers\Dachboard\MedcinController::class)->getNb_consultation();
        $year_patient= app(\App\Http\Controllers\Dachboard\MedcinController::class)->getAll_year();
        $year_compta=  app(\App\Http\Controllers\Dachboard\MedcinController::class)->getAllYear_compta(); 

        return view('Medcin.dashboard.index',[  'name'        => $name ,
                                                'nb_rdv'     => $nb_rdv,
                                                'nb_attente' => $nb_attente,
                                                'nb_urgence' => $nb_urgence,
                                                'nb_consultation' => $nb_consultation,
                                                'year_patient' => $year_patient,
                                                'year_compta' => $year_compta
                                             ]);

    }
    if( Auth::guard('admin')->check() ){
        return app(\App\Http\Controllers\CabinetController::class)->dash( request() );
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
    Route::resource('Confreres', 'ConfrereController');


    // Verifier l'etat du patient pour actualiser le panneau de secretaire
    Route::get('CheckPatientStatut', 'SalleAttenteController@check_patient_sec');

    


    // paiement route
        //-1 paiement consultation d'un patient X
    Route::get('/Paiement/{id}','PaimentController@liste_paiement');
    Route::get('/Details_paiement/{id}','PaimentController@detail_paiment');
    Route::post('/paiement/{id}','PaimentController@paiement');
        //-2 paiement, depense cabinet.. 
    Route::get('/JournalPaiement', 'JournalpaiementController@journal_paiement');
    Route::get('/JournalPaiement/createDepense', 'JournalpaiementController@CreateDepense');
    Route::get('/JournalPaiement/deleteDepense/{id}', 'JournalpaiementController@DeleteDepense');



    
    // Fiche Patient
    Route::get('/PatientF/{id}','PatientController@GetFiche');
        
    
    
});

#################################   Secretary Routes End   ################################





#-----------------------------------------------------------------------------------------#



#################################   Medcin Routes start   ################################



Route::group(['middleware' => ['auth:medcin']], function () {

    // Consultation Routes
    Route::resource('Consultation', 'ConsultationController');
    Route::get('Medicament/Search', 'MedicamentController@autocomplete_Medcin_Medica');
    Route::get('Examens/Example', 'ExamenController@ExamsNamesExamples');

    

    // Consultation Cabinet Routes
    Route::get('/ListeConsultations', 'ConsultationController@ListeDesConsultations');
    Route::delete('/ListeConsultationCabinet/delete/{Deletedid}', 'ConsultationController@destroyCabinet');
    Route::get('/ConsultationEdit/{id}', 'ConsultationController@ConsultationEditView');
    Route::POST('/ConsultationEdit/{id}', 'ConsultationController@UpdateConsultation');


    // Consultation à domicile Routes
    Route::get('ADomicile', 'ConsultationController@ConsultationADomicile');
    Route::post('/ADomicile', 'ConsultationController@StoreAdomicile');
    

    // Certificat 
    Route::resource('Certificat', 'CertificatController' );
    Route::post('CreateCertificat', 'CertificatController@store' );
    Route::get('CreateCertificat', 'CertificatController@createForm' );
    Route::get('PrintCertf/{id}', 'CertificatController@printCert' ); //=> print



    // lettre au confreres route
    Route::resource('LettreAuConfrere', 'LettreAuConfrereController'); // Crud
    Route::get('LettresAuConfreres', 'LettreAuConfrereController@GetListe');// list des lettres
    Route::get('LettreAuConfrerePatient','LettreAuConfrereController@autocomplete_patient');
    Route::get('Lettre/{id}','LettreAuConfrereController@printLetter'); // imprimer une lettre


    // Fiche Patient
    Route::get('FichePatient/{id}','PatientController@fichepourMedecin'); // imprimer une lettre
    

    /// Dossier Medical : /DossierMedical
    Route::get('DossierMedical','PatientController@DossierMedical_mainForSearch'); // imprimer une lettre
    Route::get('DossierMedical/{id}','PatientController@DossierMedical_GetIt'); // imprimer une lettre

    Route::get('Ressource/Image/{id}','FichierController@GetImage');
    Route::get('Ressource/Video/{id}','FichierController@GetVideo');
    Route::get('Ressource/PDF/{id}','FichierController@GetPDF');
    Route::get('Ressource/ZIP/{id}','FichierController@GetZIP');

    // Ordonnance Route
    Route::get('/Ordonnance/{ordonnanceid}', 'OrdonnanceController@GetOrdonnancePDF');

    // Paramètres de compte
    Route::get('MedcinParametres', 'MedcinController@Account_Settings');
    Route::post('MedcinParametres', 'MedcinController@Account_Settings_change');

    // Lien vers la signature
    Route::get('/Signature/{filename}','SignatureController@getImage');

    // Check Consultation pipe / buffer :P
    Route::get('/CheckForConsultation','SalleAttenteController@checkSalle');
    //charts
        //1 patient
        route::get('/YearPatient','Dachboard\MedcinController@getYearPatientData');
        route::get('/MonthDayPatient','Dachboard\MedcinController@getMonthPatientData');
        //2 compta
        route::get('/YearCompa','Dachboard\MedcinController@getYearCompta');
        route::get('/DetailYearCompta','Dachboard\MedcinController@getMonthCompta');
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