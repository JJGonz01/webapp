<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\patient;
use App\Models\user;
use App\Models\Therapy;
use App\Models\SessionPeriod;
use App\Models\Testdata;
use App\Models\Session;
use App\Models\patientevent;



class TestController extends Controller
{
     
    public function index(Request $request){
        return Testdata::all();
    }
    
    public function addStep(){
        if(!Auth::check()){
            return "false"; 
        }
        
        $user = Auth::user();
        $userid = $user->id;
        $tests = Testdata::where('user_id', $userid)->get();
        if ($tests->isEmpty()) {
            $test = new Testdata();
            $test->user_id = $userid;
            $test->currentstep = 0;
        } else {
            $test = $tests->first();
        }
        $test->currentstep = ($test->currentstep)+1;
        $test->save();
        return $test -> currentstep;
    }

    public function resettest(){
        if(!Auth::check()){
            return "false"; 
        }
        
        $user = Auth::user();
        $userid = $user->id;
        $tests = Testdata::where('user_id', $userid)->get();
        if ($tests->isEmpty()) {
            $test = new Testdata();
            $test->user_id = $userid;
        } else {
            $test = $tests->first();
        }
        $test->currentstep = 0;
        $test->save();
        return $test -> currentstep;
    }

    public function getCurrentStep(){

        if(!Auth::check()){
            return false; 
        }
        
        $user = Auth::user();
        $userid = $user->id;
        $tests = Testdata::where('user_id', $userid)->get();
        if ($tests->isEmpty()) {
            $test = new Testdata();
            $test->user_id = $userid;
            $test->currentstep = 0;
        } else {
            $test = $tests->first();
        }

        $responses = array();
        $responses["step"] = $test->currentstep;
        return $responses;
    }

    public function getResults(){
        
        if(!Auth::check()){
            return false; 
        }
        
        $user = Auth::user();
        $userid = $user->id;
        $tests = Testdata::where('user_id', $userid)->get();

        if ($tests->isEmpty()) {
            $test = new Testdata();
            $test->user_id = $userid;
        } else {
            $test = $tests->first();
        }
        
        return $test;
    }
    public function checkStep(string $id){
        if(!Auth::check()){
            return false; 
        }
        $user = Auth::user();
        date_default_timezone_set('Europe/Madrid');
        switch($id){
            case "2": 
                $patients = Patient::where('user_id', $user->id)->get();
                if(count($patients) > 0){
                    return true;
                }else{
                    return false;
                }
            case "4":
                $therapies = Therapy::where('user_id', $user->id)->get();
                if(count($therapies) > 0){
                    foreach($therapies as $therapy){
                        $session = SessionPeriod::where('therapy_id', $therapy->id)->get();
                        $sessionjson = $session[0]->durations;
                        $json = json_decode($sessionjson);
                        if(count($json) == 2){
                            return "2";
                        }
                    }
                    return "1";
                }else{
                    return "0";
                }
            case "7":
                $therapies = Therapy::where('user_id', $user->id)
                ->whereRaw('LOWER(name) = ?', ["plan con reglas"])
                ->get();

                if(count($therapies) > 0){
                    foreach($therapies as $therapy){
                        $session = SessionPeriod::where('therapy_id', $therapy->id)->get();
                        $sessionjson = $session[0]->durations;
                        $json = json_decode($sessionjson);
                        if(count($json) == 1){
                            if ($json[0]->duration_rest == 2 && $json[0]->duration_t1 == 2 && $json[0]->duration_t2 == 2) {
                                if(!empty(json_decode($therapy->rules)) || $therapy->rules == "empty"){ 
                                    $rules = json_decode($therapy->rules);
                                    $rulescero = json_decode($rules[0]);
                                    if(strpos($rulescero->conditions, "sensor_movement") && strpos($rulescero->conditions, "high") &&
                                        strpos($rulescero->actions, 'message":"{')){
                                        return "3";
                                    }
                                }
                            }
                        }
                    }
                    return "0";
                }
                else return "0";
            
                return "0";
            
            case "10":
                $objectives = patientevent::where('user_id', $user->id)
                ->where(function($query) {
                    $query->whereRaw('LOWER(name) = ?', ["examen"])
                        ->orWhereRaw('LOWER(name) = ?', ["exámen"]);
                })
                ->get();
                if(count($objectives) > 0){
                    foreach($objectives as $objective){
                        if($objective->type == "scholastic"){
                            $steps = json_decode($objective -> steps);
                            if(count($steps) == 3){
                                $hasallsteps = true;
                                $i = 0;
                                $str = "";
                                foreach($steps as $step){
                                    $i += 1;
                                    
                                    if(strtolower($step->name) !=  ("tema".' '.$i)){
                                        $hasallsteps = false;
                                        $str = $str." tema".' '.$i;
                                    }
                                }
                                if($hasallsteps){
                                    return "3";
                                }
                            }
                        }
                    }
                    return "0";
                }
                else return "0";
            case "13":
                $today = date('Y-m-d');
                $sessions = Session::where('date_start', $today)->get();
                

                if(count($sessions) > 0){
                    foreach($sessions as $session){
                        if($session->movement == 1 && $session->percentage == 20){
                            $studyplan = Therapy::find($session->therapy_id);
                            if(strtolower($studyplan -> name) == "plan con reglas"){

                                $currentHour = date('H:i:s');
                                $sixMinutesFromNow = date('H:i:s', strtotime('+6 minutes'));
                                $inputTime = $session -> time_start;
                                $dayselected = $session -> date_start; 
                                if ($inputTime <= $sixMinutesFromNow) {
                                    return "3";
                                }
                            }
                        }
                    }
                    return "0";
                }
                return "0";
                
                

            default:
                return false;
        }
    }
    public function endTask(){

        if(!Auth::check()){
            return false; 
        }
        
        $user = Auth::user();
        $userid = $user->id;
        $tests = Testdata::where('user_id', $userid)->get();
        if(!$tests){
            $tests = new Testdata();
            $tests->user_id = $user->id;
        }

        $now = now();

        $jsonData = json_encode($tests[0] ->actions);
        $tempFolderPath = sys_get_temp_dir();
        $tests[0] ->actions_temp = '[]';
        $tests[0]->save();
        $filename = 'test.json';/// . uniqid() . '.json'; 

        $file_path = $tempFolderPath . '/' . $filename; 
        $filename = ($user->name).($now).'_test.json';
        if (file_put_contents($file_path, $jsonData) !== false) {
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename="'.$filename.'"');
            header('Content-Length: ' . filesize($file_path));
            readfile($file_path);
            unlink($file_path); 
            exit;
        } else {
            http_response_code(500); 
        }
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $times)
    { 
        if(!Auth::check()){
            return false; 
        }
        $user = Auth::user();
        $userid = $user->id;
        $responses = array();
        $name = $request -> input("name");
        $requestquestions = json_encode($request->all());
        $tests = Testdata::where('user_id', $userid)->get();
       
        for($i = 0; $i<$times; $i++){
            $responses[$name.$i] = $request -> input("q".$i);
        }

        if ($tests->isEmpty()) {
            $test = new Testdata();
            $test->user_id = $userid;
        } else {
            $test = $tests->first();
        }

        $currentjson = json_decode($test->actions, true);
        $currentjson[$name] = $responses;
        $jsonactions_enc = json_encode($currentjson);
        $test->actions = $jsonactions_enc;
        
        $test->save();
        return $responses;
    }
}