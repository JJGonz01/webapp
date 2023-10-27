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
use Carbon\Carbon; //Para cargar las fechas


class SessionsController extends Controller
{
    
    public function index()
    {

    }

    public function create(string $patient_id)
    {
        $patient = patient::find($patient_id);
        $usuario = Auth::user();
        $therapiesList = Therapy::where('user_id',$usuario -> id)->get();
        $sessiones = $patient->session;
        return view('sessions.create_session',  ['patient' => $patient, 'therapies' => $therapiesList, 'sessions'=> $sessiones]);
    }

    public function store(Request $request, string $patient_id)
    {
    
        $today = Carbon::now();
        echo $today->toDateTimeString();

        //dd($request);
        $request -> validate([
            'date_start' =>'required|unique:sessions|date_format:Y-m-d\TH:i|after_or_equal:' . $today,
            'description' => 'max:255',
            'therapy_id' => 'required | max:255',           
            'movement' => 'required',
            'porcentaje' => 'required|numeric|between:1,100',
            'modoJuego' => 'max:255'
        ]);

        $session = new Session;
        
        switch($request->movement){
            case "Bajo":
                $session-> movement = 0.4;
                break;
            case "Medio":
                $session-> movement = 0.6;
                break;
            case "Alto":
                $session-> movement = 0.9;
                break;
        }
        
        
        $session-> percentage = $request-> porcentaje;
        $session-> description = $request-> description;
        $session-> modoJuego = $request-> modoJuego;

        $session -> date_start = $request -> date_start;
        $session -> description = $request-> description;
        $session -> therapy_id = $request -> therapy_id;
        $session -> patient_id = $patient_id;
        $session -> save();    
        $patient = patient::find($patient_id);
        $patient->session()->save($session);

        $session_res = new SessionResult;
        $session_res->session_id = $session->id;
        $session_res->save();

        return redirect()->route('patient_show', ['id'=> $patient_id])->with('success','Sesion creado correctamente');
    }

    public function show($id)
    {
        $session = Session::find($id);
        $session_results = SessionResult::where('session_id', $id)->get();
        //sensor corazon
        $bpm_valores = $session_results[0]->bpm_valores;
        $bpm_medios = $session_results[0]->bpm_medios;
        
        $move_valores = $session_results[0]->move_valores;
        $move_medios = $session_results[0]->move_medios;
        $limite_bpm = $session_results[0]->bpm_limite;
        $reglas = $session_results[0]->rules;

        $puntos = $session_results[0]->puntosObtenidos;
        $listaReglasIniciales = $session_results[0]->listaReglasIniciales;

        if($session -> completed == false && $session -> running == false) //si no se ha ejecutado aun
            return view('sessions.show_session', ['session' => $session]);
        else if($session -> completed == false && $session -> running == true) //si se esta ejecutando ahora
            return view('sessions.show_session_running', ['session' => $session]);
        else if($session -> completed == true) //si ya se acabo
            return view('sessions.show_session_completed', 
            ['session' => $session, 'bpm_valores' => $bpm_valores, 'bpm_medios'=>$bpm_medios,
            'move_valores'=>$move_valores, 'move_medios'=>$move_medios, 'limite_bpm'=>$limite_bpm, 'reglas'=>$reglas,
             'puntos' => $puntos,'listaReglasIniciales'=> $listaReglasIniciales]);

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
        $patient = patient::find($id);
        $usuario = Auth::user();
        $therapiesList = Therapy::where('user_id',$usuario -> id)->get();
        $sessiones = $patient->session;
        return view('sessions.edit_session',  ['patient' => $patient, 'therapies' => $therapiesList, 'sessions'=> $sessiones]);
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
            'modoJuego' => 'max:255'
        ]);
        
        switch($request->movement){
            case "Bajo":
                $session-> movement = 0.4;
                break;
            case "Medio":
                $session-> movement = 0.6;
                break;
            case "Alto":
                $session-> movement = 0.9;
                break;
        }
        
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
     * 
     */

     /**
      * EL reloj llama para coger el calendario de sesiones del paciente!
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
    
        if($sesiones->isEmpty()){ //aqui es que no hay sesiones programadas :I
           
         }
    
      $listaSesionesAlumno = array();

      foreach($sesiones as $sesion){
            if($sesion -> completed == false){
                $terapia = Therapy::where('id', $sesion->therapy_id)->get();
                $periodo = SessionPeriod::where('therapy_id', $sesion->therapy_id)->first();
                $listaSesionesPeriods = []; //añado los periodos junto a la fecha por la que empieza
                $listaSesionesPeriods[] = $sesion->date_start;
                $listaSesionesPeriods[] = $periodo->durations;
                $listaSesionesAlumno[] = $listaSesionesPeriods;
                $listaEnviar = json_encode($listaSesionesPeriods);
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
        $dateString = $request->input('date');
        $bpm_lim = $request->input('bpm_lim');
        $move_lim = $request->input('mov_lim');
        //$dateString = '2023-05-26T00:10:54.917328Z';

        $date = Carbon::parse($dateString);
        
        $formattedDate = $date->format('Y-m-d H:i:s');
        
        $session = Session::where('date_start', $formattedDate)->get();
        $sessionResult = SessionResult::where('session_id', $session[0]->id)->get();
        //$terapia = Therapy::where('id', $session->therapy_id)->get();

        if(!$session->isEmpty()){
        $session[0]->running = true; //puesto que es la unica
        $session[0]->bpm_lim = $bpm_lim; 
        $session[0]->move_lim = $move_lim; 

        //$sessionResult[0] -> listaReglasIniciales = $terapia -> rules; 

        $session[0]->save();

            return response()->json([
                'response' => $session[0]
            ]);
         }

         return response()->json([
            'response' => $date
        ]);

    }


    /**
     * A traves de la fecha el controlador termina la sesion
     * HAY QUE PASARLE LA FECHA
     */

    public function sessionFinish(Request $request){

        $dateString = $request->input('date');
        //$dateString = '2023-05-26T00:10:54.917328Z';

        $date = Carbon::parse($dateString);
        
        $formattedDate = $date->format('Y-m-d H:i:s');
        $results = Session::where('date_start', $formattedDate)->get();
        


        if(!$results->isEmpty()){

            $valores_bpm = json_encode($request->input('bpm_valores'));


            $valores_move = json_encode($request->input('move_valores'));

            
            $session_results = SessionResult::where('session_id', $results[0]->id)->get(); //cogemos el objeto de resultados para rellenarle los valores
            

            $session_results[0] -> bpm_valores = $valores_bpm;
            $session_results[0] -> move_valores = $valores_move;
            $session_results[0] -> save();

            $results[0]->running = false; 
            $results[0]->completed = true; 
            $results[0]->save();

            return response()->json([
                'response' => "funciono!"
            ]);
         }

         return response()->json([
            'response' => $date
        ]);
    }

    public function sessionFinish2(Request $request){

        $dateString = $request->input('date');
        //$dateString = '2023-05-26T00:10:54.917328Z';

        $date = Carbon::parse($dateString);
        
        $formattedDate = $date->format('Y-m-d H:i:s');
        
        // Realiza la consulta en la base de datos
        $results = Session::where('date_start', $formattedDate)->get();

        if(!$results->isEmpty()){
            $reglas = json_encode($request->input('reglas'));
            $valores_bpm_medios = json_encode($request->input('bpm_medios'));
            $valores_move_medios = json_encode($request->input('move_medios'));
            $puntosObtenidos = json_encode($request->input('puntos'));

            $limite_bpm = $request->input('limite_bpm');
            
            $session_results = SessionResult::where('session_id', $results[0]->id)->get(); //cogemos el objeto de resultados para rellenarle los valores
            $session_results[0] -> rules = $reglas;
            $session_results[0] -> bpm_medios = $valores_bpm_medios;
            $session_results[0] -> move_medios = $valores_move_medios;
            $session_results[0] -> bpm_limite = $limite_bpm; //el valor q separa alto de bajo
            $session_results[0] -> puntosObtenidos = $puntosObtenidos; //el valor q separa alto de bajo
            $session_results[0] -> save();

            $results[0]->running = false; 
            $results[0]->completed = true; 
            $results[0]->save();

            return response()->json([
                'response' => "funciono2!"
            ]);
         }

         return response()->json([
            'response' => $date
        ]);
    }

    /**
     * Para recuperaque el reloj coja las reglas que tendra la sesion
     */
    public function getSessionRules(Request $request){
        
        $dateString = $request->input('date');
        $date = Carbon::parse($dateString);
            
        $formattedDate = $date->format('Y-m-d H:i:s');
            
        $session = Session::where('date_start', $formattedDate)->get();
        if(empty($session[0])){
            return response()->json([
                'reglas' => "none",
                'move' => "none",
                'bpm' => "none",
                'modoJuego' => "none"
            ]);
        }
        $terapia = Therapy::where('id', $session[0]->therapy_id)->first();
        
        if(json_decode($terapia->rules) == "empty")
            return response()->json([
                'reglas' => "empty",
                'move' => $session[0]-> movement,
                'bpm' => $session[0]-> percentage,
                'modoJuego' => $session[0]->modoJuego
        ]);
        else
            return response()->json([
                'reglas' => $terapia->rules,
                'move' => $session[0]-> movement,
                'bpm' => $session[0] -> percentage,
                'modoJuego' => $session[0] ->modoJuego
            ]); 

    }
    
}
