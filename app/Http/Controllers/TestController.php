<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\patient;
use App\Models\user;
use App\Models\Testdata;



class TestController extends Controller
{
     
    public function index(Request $request){
        return  Testdata::all();
    }

    public function endTask(){

        $user = Auth::user();
        $userid = $user->id;
        $tests = Testdata::where('user_id', $userid)->get();
        $jsonData = json_encode($tests[0] ->actions_temp);
        
        $tempFolderPath = sys_get_temp_dir(); // Obtener el directorio temporal del servidor
        $tests[0] ->actions_temp = '[]';
        $tests[0]->save();
        $filename = 'test.json';/// . uniqid() . '.json'; // Generar un nombre de archivo único

        $file_path = $tempFolderPath . '/' . $filename; // Ruta completa hacia el archivo temporal

         // Reemplaza 'yourData' con el valor JSON que deseas

        if (file_put_contents($file_path, $jsonData) !== false) {
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename="test.json');// . basename($file_path) . '"');
            header('Content-Length: ' . filesize($file_path));
            readfile($file_path);
            unlink($file_path); // Eliminar el archivo temporal después de la descarga
            exit;
        } else {
            http_response_code(500); // Cambia a un código de error apropiado si es necesario
        }
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    { 

        if(!Auth::check()){
            return false; 
        }
    
        $user = Auth::user();
        $userid = $user->id;
        $taskid = $request -> input("taskId");
        $type = $request -> input("type");
        $dateTime = $request -> input("dateTime");
        $differenceTime = $request -> input("differenceTime");
        $actionId = $request -> input("actionId");
        $tests = Testdata::where('user_id', $userid)->get();
        if (count($tests) > 0) {
            $test = $tests->first();
        }
        else{
            $test = new Testdata;
            $test->user_id = $userid;
        }
        
        $datajson = array(
            "differenceTime" => $differenceTime,
            "actionId" => $actionId,
            "type" => $type
        );
        
        $jsonactions_enc = $test->actions;
        $jsonactions_enc_temp = $test->actions_temp;

        $jsonactions = json_decode($jsonactions_enc, true); 
        $jsonactions_temp = json_decode($jsonactions_enc_temp, true); 


        if (!isset($jsonactions[$taskid])) {
            $jsonactions[$taskid] = array(); 
        }
        
        if (!isset($jsonactions_temp[$taskid])) {
            $jsonactions_temp[$taskid] = array(); 
        }

        $newItem = array(
            $dateTime => $datajson
        );
        
        $jsonactions[$taskid] = array_merge($jsonactions[$taskid], $newItem);
        $jsonactions_temp[$taskid] = array_merge($jsonactions_temp[$taskid], $newItem);
        
        // Codifica nuevamente el JSON
        $jsonactions_enc = json_encode($jsonactions);
        $jsonactions_enc_temp = json_encode($jsonactions_temp);
        
        $test->actions = $jsonactions_enc;
        $test->actions_temp = $jsonactions_enc_temp;
        
        $test->save();
        return $actionId;
    }
}