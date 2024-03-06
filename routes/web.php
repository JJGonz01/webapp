<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PatientsController;
use App\Http\Controllers\TherapiesController;
use App\Http\Controllers\SessionsController;
use App\Http\Controllers\SessionsDataController;
use App\Http\Controllers\SessionPeriodsController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\RuleController;
use App\Http\Controllers\Clock_messageController;
use App\Http\Controllers\IndividualRuleController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\authentication;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('/login', function () {
    return view('layouts.app');
})->name('main');

Route::post('/userlogin', [authentication::class, 'login'])
->name('userlogin');

Route::get('/logout', function () {
    return view('layouts.app');
})->name('main');

Route::get('/dashboard', function () {
})->middleware('auth');

Route::get('/home', function () {
    return view('general');
})->name('register');

Route::group( ['middleware' => 'auth' ], function()
{
    Route::get('/patients', [PatientsController::class, 'index'])->name('patients_index');

 /** 
  * PACIENTES
  */
    Route::get('/HOME', function () {
        return view('general');
    })->name('main');


    //SHOW_PATIENT Mostrar un unico paciente
    Route::get('/patient/{id}', [PatientsController::class, 'show'])
    ->name('patient_show');

    Route::get('/avatar/{id}', [PatientsController::class, 'avatar'])
    ->name('avatar_show');

    //Formulario de actualizacion de paciente (no hay accion, es el form)
    Route::get('/patientedit/{id}', [PatientsController::class, 'showFormUpdate'])
    ->name('patient_update');

    //UPDATE_PATIENT Actualizar el paciente e ir a menu de show
    Route::post('/patient/{id}', [PatientsController::class, 'update'])
    ->name('patient_complete_update');

    //Borrar el paciente
    Route::delete('/patient/{id}', [PatientsController::class, 'destroy'])
    ->name('patient_destroy');


    Route::get('/createpatient', function () {
        return view('patients.create_patient');
    })->name('patients_create');


    //CREATE_PATIENT_POST (Llamada al controlador)
    Route::post('/createpatient', [PatientsController::class, 'store'])
    ->name('patients_create');


    /***
     * TERAPIAS
     */

    //INDEX_ALL_PATIENTS Mostrar lista de pacientes
    Route::get('/therapies', [TherapiesController::class, 'index'])
    ->name('therapies_index');

    //Formulario de actualizacion de paciente (no hay accion, es el form)
    Route::get('/therapyedit/{id}', [TherapiesController::class, 'showFormUpdate'])
    ->name('therapy_update');

    //UPDATE_PATIENT Actualizar el paciente e ir a menu de show
    Route::post('/therapyedit/{id}', [TherapiesController::class, 'update'])
    ->name('therapy_complete_update');

    //Borrar la terapia
    Route::delete('/therapydelete/{id}', [TherapiesController::class, 'destroy'])
    ->name('therapy_destroy'); 

    /***
     * SESIONES
     */

    //Sesion Mostrar una unica sesion
    Route::get('/session/{id}', [SessionsController::class, 'show'])
    ->name('session_show');

    Route::get('/sessionedit/{id}', [SessionsController::class, 'edit'])
    ->name('session_edit');

    Route::post('/sessionupdate/{id}', [SessionsController::class, 'update'])
    ->name('session_update');

    Route::get('/resultsession/{id}', [SessionsController::class, 'result'])
    ->name('session_results');

    Route::put('/exitsessions/{id}',[SessionsController::class, 'update']);

    Route::get('/sessionorder/getwatchresponse/{id}',[SessionsController::class, 'getSessionWatchResponseData'])->name('order_create'); ///el json pone la orden de nuevo a sero

    //Reglas

    Route::get('/rulesForSession', [RuleController::class, 'show'])->name('rules_create');

    Route::get('/createRule', [IndividualRuleController::class, 'create'])->name('rule_create');

    Route::post('/createRule', [IndividualRuleController::class, 'store'])
    ->name('rule_create');

    Route::get('/sessiondata/{id}', [SessionsController::class, 'getSessionData'])
    ->name('session_data');

    /**
     * PERIODOS DE SESION
     */

    //La id es la id de la terapia en la que se encuentra
    Route::get('/createperiod/{session_id}', [SessionPeriodsController::class, 'create'])
    ->name('speriod_create');
    Route::post('/createperiod/{session_id}', [SessionPeriodsController::class, 'store'])
    ->name('period_create');

    //Borrar paciente
    Route::delete('/sessiondestroy/{id}{patient_id}', [SessionsController::class, 'destroy'])
    ->name('session_destroy');

    //Sesion Mostrar un unico paciente
    Route::get('/period/{id}', [SessionsController::class, 'show'])
    ->name('period_show');

    //terapias
    Route::get('/createtherapy', [TherapiesController::class, 'create'])->name('therapies_create');

    Route::post('/createtherapy', [TherapiesController::class, 'store'])
    ->name('therapies_create');

    Route::get('/therapy/{id}', [TherapiesController::class, 'show'])->name('therapy_show');

    Route::get('/on_therapy/{id}', [TherapiesController::class, 'showPublished'])->name('therapy_see');


    Route::get('/forum', [TherapiesController::class, 'indexPublishedTherapies'])->name('forum');
    Route::get('/upload_therapy/{id}', [TherapiesController::class, 'upload'])->name('uploadther');
    Route::get('/download_therapy/{id}', [TherapiesController::class, 'download'])->name('downloadther');
    Route::get('/remove_therapy/{id}', [TherapiesController::class, 'removeFromCloud'])->name('removether');
    /***
     * SESIONES
     */

    Route::get('/createobjective/{patient_id}', [PatientsController::class, 'createObjective'])->name('objetives_create');
    Route::post('/createobjective/{patient_id}', [PatientsController::class, 'storeObjective'])->name('objetives_create');
    
    Route::get('/createsession/{patient_id}', [SessionsController::class, 'create'])->name('sessions_create');
    Route::get('/createsessiondated/{patient_id}/{date_start}', [SessionsController::class, 'createWithDate'])->name('sessions_create_withdate');
    Route::post('/createsession/{patient_id}', [SessionsController::class, 'store'])->name('sessions_create_post');

        Route::get('/general', function () {
            return view('general');
        })->name('general');

    Route::get('/messages/index', [Clock_messageController::class, 'indexall'])
    ->name('messages-index');
    Route::post('/messages/create', [Clock_messageController::class, 'store'])
    ->name('messages-create');
});
    // El reloj llamará a este endpoint para recoger las horas y periodos de cada sesion que tenga que analizar
    Route::get('/session/userdata/{id}',[SessionsController::class, 'getUserSessionList'])->name('session_getSessionList');

    //el reloj recoge las reglas
    Route::put('/getrules',[SessionsController::class, 'getSessionRules'])->name('session_getrules');

    Route::put('/start',[SessionsController::class, 'startSession'])->name('start'); //rel reloj envia info de la sesion

    Route::put('/finish',[SessionsController::class, 'sessionFinish'])->name('finish'); //rel reloj envia info de la sesion

    Route::put('/finishExtra',[SessionsController::class, 'sessionFinish2'])->name('finish2'); //rel reloj envia info de la sesion
    
    Route::post('/session/response',[SessionsController::class, 'getSessionDataWatch'])->name('order_response'); //endpoint al que llama el reloj para poner su respuesta!


/**
 * AUTHENTICATION
 */
Auth::routes();
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

/**
 * TEST
    */
    Route::get('/aaaa', [TestController::class, 'index'])
    ->name('aaa');

    Route::get('/download', [TestController::class, 'endTask'])
    ->name('download');

    Route::get('/teststep', [TestController::class, 'store'])
    ->name('testsend');


