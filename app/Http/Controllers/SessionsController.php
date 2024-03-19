<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Session;
use App\Models\SessionResult; 
use App\Models\Therapy;
use App\Models\SessionPeriod;
use App\Models\SessionData;
use App\Models\patient;
use App\Models\Regla;
use App\Models\FuzzyData;
use App\Models\therapy_session_completed;
use App\Models\patientevent;
use Illuminate\Validation\Rule;
use Carbon\Carbon; //Para cargar las fechas
use Illuminate\Support\Facades\Validator;

class SessionsController extends Controller
{
    public function create(string $patient_id)
    {
        $patient = patient::find($patient_id);
        $usuario = Auth::user();
        $therapiesList = Therapy::where('user_id',$usuario -> id)->get();
        $sessiones = Session::where('patient_id',$patient -> id)->get();
        $objectives = patientevent::where('patient_id', $patient->id) -> get();
        return view('sessions.create_session',  ['patient' => $patient, 'therapies' => $therapiesList, 'sessions'=> $sessiones, 'objectives' =>$objectives, 'date_start' => "none"]);
    }

    public function createWithDate(string $patient_id, string $date_start)
    {
        $patient = patient::find($patient_id);
        $usuario = Auth::user();
        $therapiesList = Therapy::where('user_id',$usuario -> id)->get();
        $sessiones = $patient->session;
        $objectives = patientevent::where('patient_id', $patient->id) -> get();
        return view('sessions.create_session',  ['patient' => $patient, 'therapies' => $therapiesList, 'date_start' => $date_start,'objectives' =>$objectives, 'sessions'=> $sessiones]);
    }

    public function store(Request $request, string $patient_id)
    {
        if(!Auth::check()){
            return view('layouts.app'); 
        }
    
        $usuario = Auth::user();

        $today = Carbon::now();
        $today = now();
        $fiveMinutesBefore = $today->subMinutes(5)->format('Y-m-d\TH:i');

        echo $today->toDateTimeString();
        //dd($request);
        $request -> validate([
            'name' => 'required|min:1',
            'description' => 'max:255',
            'session_repeat'=> 'required',
            'date_start' =>[
                'required',
                'date_format:Y-m-d',
                Rule::unique('sessions')->where(function($query) use ($request){
                    return $query->where('date_start', ($request->date_start))
                    ->where('time_start', ($request->time_start));
                }),
                'after_or_equal:today'
            ],
            'time_start' =>[
                'required',
                'date_format:H:i',
                function ($attribute, $value, $fail) use ($request){
                    $dateTime = $request->date_start . ' ' . $value;
                    if(strtotime($dateTime) <= time()){
                        $fail('The ' . $attribute . ' must be greater than the current time.');                    
                    }
                }
            ],
            'therapy_id' => 'required',           
            'movement' => 'required',
            'bpm' => 'required|numeric|between:1,100',
            'gamification' => 'required',
            'timer_clock'=>'',
            'hour_clock'=>'',
            'text_clock' => ''
        ]);

        $session = new Session;
        $session-> name = $request-> name;
        $session-> description = $request-> description;
        $session-> movement = $request->movement;
        $session-> percentage = $request->bpm;

        $session -> date_start = $request -> date_start;
        $session -> time_start = $request -> time_start;
        $session -> barcronometer = $request -> timer_clock;
        $session -> textcronometer = $request -> hour_clock;
        $session -> textperiod = $request -> text_clock;
        
        $session-> gamification = $request-> gamification;
        $session -> therapy_id = $request -> therapy_id;
        $session -> patient_id = $patient_id;
        $session -> completed = false;
        $session -> save();    

        $patient = patient::find($patient_id);
        $patient->session()->save($session);

        $session_res = new SessionResult;
        $session_res->session_id = $session->id;
        $session_res->save();

        $therapy_completed = new therapy_session_completed();
        $therapy = Therapy::find($request ->therapy_id);
        $durations = SessionPeriod::where('therapy_id', $therapy->id)->first();

        $therapy_completed-> name = $therapy-> name;
        $therapy_completed->user_id = $usuario->id;
        $therapy_completed-> author = $usuario-> name;
        $therapy_completed-> description = $therapy-> description;
        $therapy_completed-> durations = $durations-> durations;
        $therapy_completed->rules = $therapy->rules;
        $therapy_completed->session_id = $session -> id;

        $therapy_completed->save(); 

        return redirect()->route('patient_show', ['id'=> $patient_id])->with('success','Sesion creada correctamente');
    }

    public function show($id)
    {
        $session = Session::find($id);
        $patient = patient::find($session->patient_id);
        $session_results = SessionResult::where('session_id', $id)->get();
        //sensor corazon
        $bpm_valores = $session_results[0]->bpm_valores;
        $bpm_medios = $session_results[0]->bpm_medios;
        
        $move_valores = $session_results[0]->move_valores;
        $move_medios = $session_results[0]->move_medios;
        $limite_bpm = $session_results[0]->bpm_limite;
        $limite_move = $session->movement;
        $reglas = $session_results[0]->rules;

        $puntos = $session_results[0]->puntosObtenidos;
        $listaReglasIniciales = $session_results[0]->listaReglasIniciales;

        $patient = patient::find($patient_id);
        $usuario = Auth::user();
        $therapiesList = Therapy::where('user_id',$usuario -> id)->get();
        $sessiones = $patient->session;
        $objectives = patientevent::where('patient_id', $patient->id) -> get();
  
        dd($session->completed);

        if($session -> completed == false)// && $session -> running == false) //si no se ha ejecutado aun
            return view('sessions.show_session',  ['patient' => $patient, 'therapies' => $therapiesList, 'date_start' => $date_start,'objectives' =>$objectives, 'sessions'=> $sessiones]);
        else if($session -> completed == false && $session -> running == true) //si se esta ejecutando ahora
            return view('sessions.show_session_running', ['patient' => $patient, 'therapies' => $therapiesList, 'date_start' => $date_start,'objectives' =>$objectives, 'sessions'=> $sessiones]);
        else if($session -> completed == true) //si ya se acabo
            return view('sessions.show_session_completed', 
            ['session' => $session, 'bpm_valores' => $bpm_valores, 'bpm_medios'=>$bpm_medios,'patientId'=>$patient->id,
            'move_valores'=>$move_valores, 'move_medios'=>$move_medios, 'limite_bpm'=>$limite_bpm, 'limite_move' => $limite_move,'reglas'=>$reglas,
             'puntos' => $puntos,'listaReglasIniciales'=> $listaReglasIniciales, 'patient' => $patient]);

    }

    public function run($id){
        $session = Session::find($id);
        $session_periods = SessionPeriod::where('session_id', $id)->get();
       // dd($session_periods[0]);
        if($session -> completed == false) //Compruebas si es una sesion a runear o a mirar datos
        {
            $session -> running = true;
            $session -> save();

            //TODO QUE LLEVE A DIFERENTES VIEW SI ESTAN ACABADAS O NO!
        }
        return view('sessions.run_session', ['session' => $session, 'periods' => $session_periods[0]-> durations]);
    }

    public function exitRunningSession($id){
        $session = Session::find($id);
        $session -> running = false;
        $session -> save();

        $response = array('success' => true);

        // Devuelve el array en formato JSON
        return json_encode($response);
    }

    public function result($id){
        $session = Session::find($id);
        $session -> completed = true;
        $session -> running = false;
        $session -> save();
        return view('sessions.ended_session', ['session' => $session]);
    }

    public function getSessionData($id)
    {
        $session = Session::find($id);
        $session_data = SessionData::where('session_id', $id)->get();
        $response = [
            'running' => $session -> running,
            'completed' => $session -> completed,
            'stage' => $session -> stage,
            'order' => $session_data[0] -> order
        ];
    
        return response()->json($response);
    }


    public function getSessionDataWatch(Request $request) 
    {
        $session_id = $request->input('session');
        $order_watch = $request->input('response');

        if (empty($order_watch)) {
            return response()->json(['message' => 'Input string is empty']);
        }

        $session_data = SessionData::where('session_id', $session_id)->get();


        $session_data[0]->watch_response = $order_watch; 
        $session_data[0] -> order = 0; 
  
        $session_data[0] -> save();
        return response()->json([
            'message' => $session_id
        ]);
    }


    public function putSessionDataWatchResponse(Request $request, $id)
    {
        $session_data = SessionData::where('session_id', $id)->get();
        $session_data[0]->order = $order;
        $session_data[0] -> save();

        return response()->json([
            'running' => $session -> running,
            'completed' => $session -> completed,
            'stage' => $session -> stage,
            'order' => $session_data[0] -> order
        ]);
    }
    

    public function edit(string $id)
    {
        $session = Session::find($id);
        $patient = patient::find($session->patient_id);
        $usuario = Auth::user();
        $therapiesList = Therapy::where('user_id',$usuario -> id)->get();
        $therapy = Therapy::find($session->therapy_id);
        $objectives = patientevent::where('patient_id', $patient->id) -> get();
        $sessions = $patient -> session;
        $objective = patientevent::find($session->objective);

        if($session -> completed == 0)
            return view('sessions.edit_session',  ['patient' => $patient, 'therapies' => $therapiesList,'therapy' => $therapy, 'session' => $session,'objectives' =>$objectives, 'objective' => $objective, 'sessions'=> $sessions]);
        else{
            $session_results = SessionResult::where('session_id', $id)->get();
            //sensor corazon
            $bpm_valores = $session_results[0]->bpm_valores;
            $bpm_medios = $session_results[0]->bpm_medios;
            
            $move_valores = $session_results[0]->move_valores;
            $move_medios = $session_results[0]->move_medios;
            $limite_bpm = $session_results[0]->bpm_limite;
            $limite_move = $session->movement;
            $reglas = $session_results[0]->rules;

            $puntos = $session_results[0]->puntosObtenidos;
            $listaReglasIniciales = $session_results[0]->listaReglasIniciales;

            //dd($session_results);
            return view('sessions.show_session_completed', 
            ['session' => $session, 'bpm_valores' => $bpm_valores, 'bpm_medios'=>$bpm_medios,'patientId'=>$patient->id,
            'move_valores'=>$move_valores, 'move_medios'=>$move_medios, 'limite_bpm'=>$limite_bpm, 'limite_move' => $limite_move,'reglas'=>$reglas,
             'puntos' => $puntos,'listaReglasIniciales'=> $listaReglasIniciales, 'patient' => $patient]);
        }    
    }


    public function update(Request $request, string $id)
    {
        $session = Session::findOrFail($id);

        $today = Carbon::now();
        $yesterday = $today->subDay();

        $session -> date_start = $yesterday;

        echo $today->toDateTimeString();
        $session->save(); //para que la fecha, si se mantene, no de error de key

        $request -> validate([
            'date_start' =>'required|unique:sessions|after_or_equal:' . $today,
            'description' => 'max:255',
            'therapy_id' => 'required | max:255',           
            'movement' => 'required',
            'porcentaje' => 'required|numeric|between:1,100',
            'modoJuego' => 'max:255',
            'opcion'=>'',
            'barraFalta'=>'',
            'tiempoFalta' => ''
        ]);
        
        switch($request->movement){
            case "Muy Bajo":
                $session-> movement = 2; 
                break;
            case "Bajo":
                $session-> movement = 1.5; 
                break;
            case "Medio":
                $session-> movement = 0.9;
                break;
            case "Alto":
                $session-> movement = 0.6;
                break;
            case "Muy Alto":
                $session-> movement = 0.4; 
                break;
        }
        $arrayPalabras = $request->opcion;
        $progreso = is_array($request->opcion) && array_search("Barra", $arrayPalabras) !== false ? true : false;
        $minuto = is_array($request->opcion) && array_search("Reloj", $arrayPalabras) !== false ? true : false;
        $nombre = is_array($request->opcion) && array_search("Nombre", $arrayPalabras) !== false ? true : false;
        
        $session-> percentage = $request-> porcentaje;
        $relojView = array(
            'barraFalta' => $request -> barraFalta,
            'pantalla' => $request -> tiempoFalta,
            'barra' => $progreso,
            'minuto' => $minuto,
            'periodo'=> $nombre
        );


        $relojViewJson = json_encode($relojView);
        $session-> time_show = $relojViewJson;

        $session-> percentage = $request-> porcentaje;
        $session-> description = $request-> description;
        $session-> modoJuego = $request-> modoJuego;
        $session -> date_start = $request -> date_start;
        $session -> description = $request-> description;
        $session -> therapy_id = $request -> therapy_id;
        $session -> save();
        return redirect()->route('patient_show', ['id' => $session->patient_id])->with('success','Sesión editada correctamente');;
        
    }


    public function destroy(string $id, $patient_id)
    {
        $session = Session::find($id);
        $patient = Patient::find($patient_id);
        $session->patient()->dissociate();
        $session->delete();
        
        $sessions = $patient->session;
        return redirect()->route('patient_show', ['id' => $patient_id])->with('success','Sesión eliminada correctamente');;
        
    }


     /**
      * RELOJ
      * 
      * HAY QUE PASAR LA id DEL ALUMNO
      */
     public function getUserSessionList(Request $request, $id){
        
        $patient = Patient::find($id);

        if(is_null($patient) || is_null($patient->session)){
            return response()->json([
                'response' => "vacio"
            ]);
        }

        $sesiones = $patient->session;
        $sesiones_noCompletadas = [];
        $today = Carbon::now();
        $listaSesionesAlumno = array();

        foreach($sesiones as $sesion){
                if($sesion -> completed == false){
                    $fiveMinutesBefore = $today->subMinutes(5)->format('Y-m-d H:i');
                    $datetimestr = $sesion->date_start . ' ' . $sesion->time_start;
                    $datetime = Carbon::parse($datetimestr)->format('Y-m-d H:i');
                    if($datetime >= $fiveMinutesBefore){
                        $terapia = Therapy::where('id', $sesion->therapy_id)->get();
                        $periodo = SessionPeriod::where('therapy_id', $sesion->therapy_id)->first();
                        $listaSesionesPeriods = []; //añado los periodos junto a la fecha por la que empieza
                        $listaSesionesPeriods[] = $sesion->id;
                        $listaSesionesPeriods[] = $datetime;
                        $listaSesionesPeriods[] = $periodo->durations;
                        $listaSesionesAlumno[] = $listaSesionesPeriods;
                        $listaEnviar = json_encode($listaSesionesPeriods);
                    }
                }
            }
        return response()->json([
            'response' => $listaSesionesAlumno
        ]);
    }

    /**
     * A traves de la fecha el controlador comienza la sesion
     * HAY QUE PASAR FECHA SI O SI
     */
    public function startSession(Request $request)
    {
        $sessionId = $request->input('sessionId');
        $bpm_lim = $request->input('bpm_thres');
        $move_lim = $request->input('mov_thres');

        $session = Session::find($sessionId);
        $sessionResult = SessionResult::where('session_id', $session->id)->get();
        //$terapia = Therapy::where('id', $session->therapy_id)->get();
        if($session!=null){
            $session->running = true; //puesto que es la unica
            $session->bpm_lim = $bpm_lim; 
            $session->move_lim = $move_lim; 
            //$sessionResult[0] -> listaReglasIniciales = $terapia -> rules; 
            $session->save();
            return response()->json([
                'response' => $session->id
            ]);
        }
         return response()->json([
            'response' =>  "session-empty",
        ]);
    }
    /**
     * A traves de la fecha el controlador termina la sesion
     * HAY QUE PASARLE LA FECHA
     */

    public function sessionFinish(Request $request){

        $sessionId = $request->input('sessionId');
        $session = Session::find($sessionId);
        $session_results = SessionResult::where('session_id', $session->id)->get();

        if($session!=null){

            $valores_bpm = json_encode($request->input('bpm_values'));
            $valores_move = json_encode($request->input('move_values'));

            $session_results[0] -> bpm_valores = $valores_bpm;
            $session_results[0] -> move_valores = $valores_move;
            $session_results[0] -> save();

            $session -> running = false; 
            $session -> completed = true; 
            $session -> save();

            return response()->json([
                'response' => $session->id
            ]);
        }

         return response()->json([
            'response' => $sessionId
        ]);
    }

    public function sessionFinish2(Request $request){


        $sessionId = $request->input('sessionId');
        $session = Session::find($sessionId);

        if($session!=null){
            $reglas = json_encode($request->input('rules'));
            $valores_bpm_medios = json_encode($request->input('bpm_avg'));
            $valores_move_medios = json_encode($request->input('move_avg'));
            $puntosObtenidos = json_encode($request->input('points'));
            $limite_bpm = $request->input('bpm_limit');
            $session_results = SessionResult::where('session_id', $sessionId)->get(); //cogemos el objeto de resultados para rellenarle los valores
            $session_results[0] -> rules = $reglas;
            $session_results[0] -> bpm_medios = $valores_bpm_medios;
            $session_results[0] -> move_medios = $valores_move_medios;
            $session_results[0] -> bpm_limite = $limite_bpm; //el valor q separa alto de bajo
            $session_results[0] -> puntosObtenidos = $puntosObtenidos; //el valor q separa alto de bajo
            $session_results[0] -> save();
            $session->running = false; 
            $session->completed = true; 
            $session->save();

            
            return response()->json([
                'response' => $session->id
            ]);
         }
         return response()->json([
            'response' => $sessionId
        ]);
    }

    /**
     * Para recuperaque el reloj coja las reglas que tendra la sesion
     */
    public function getSessionRules(Request $request){
        
        $sessionId = $request->input('sessionid');
        $session = Session::find($sessionId);

        if(empty($session)){
            return response()->json([
                'rules' => 'none',
                'movement' => 'none',
                'bpm' => 'none',
                'gamification' => 'none',
                'barcronometer' =>'none',
                'textcronometer' =>'none',
                'textperiod' =>'none'
            ]);
        }
        $terapiaId = $session -> therapy_id;
        $terapia = Therapy::find($terapiaId);
        /*
            $session -> barcronometer = $request -> timer_clock;
            $session -> textcronometer = $request -> hour_clock;
            $session -> textperiod = $request -> text_clock;
        */
        if(json_decode($terapia->rules) == "empty")
            return response()->json([
                'rules' => "empty",
                'movement' => $session-> movement,
                'bpm' => $session-> percentage,
                'gamification' => $session -> gamification,
                'barcronometer' => $session -> barcronometer,
                'textcronometer' => $session -> textcronometer,
                'textperiod' => $session -> textperiod
            ]);
        else
            return response()->json([
                'rules' => $terapia->rules,
                'movement' => $session-> movement,
                'bpm' => $session-> percentage,
                'gamification' => $session -> gamification,
                'barcronometer' => $session -> barcronometer,
                'textcronometer' => $session -> textcronometer,
                'textperiod' => $session -> textperiod
            ]); 

    }
    
}
