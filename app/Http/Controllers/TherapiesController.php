<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Therapy;
use App\Models\patient; 
use App\Models\Session;
use App\Models\SessionPeriod;
use App\Models\ter_pat;
use Carbon\Carbon;

//TFG RECUERDA EXPLICAR PQ LAS FUNCIONES 
class TherapiesController extends Controller
{

    public function index(Request $request)
    {
        if (Auth::check()) {
            $usuario = Auth::user();
            $therapies = Therapy::where('user_id', $usuario -> id) -> get();
            return view('therapies.therapies', ['therapies' => $therapies]);
        }
        else{
            $therapies = [];
            return view('therapies.therapies', ['therapies' => $therapies]);
        }
    }
    
    public function create()
    {
        return view('therapies.create_therapy');

    }
      
    public function store(Request $request)
    {
       $today = Carbon::now();
       echo $today->toDateTimeString();

       //dd($request);
       $request -> validate([
           'name' => 'max:255|required',
           'periods' => [ //ESto es para solucionar el bug de crear terapias sin periodos
                'required',
                'array',
                'min:1',
                function ($attribute, $value, $fail) {
                    if (is_null($value[0])) {
                        $fail('Ncesitas crear al menos un periodo');
                    }
                }
            ],
           'rules' => '', 
           'juegoPuntos' => 'min:1'
       ]);
       $terapia = new Therapy;
       $terapia-> name = $request-> name;
      
       if(!Auth::check()){
        return view('layouts.app'); 
        }

       $usuario = Auth::user();


       //si no hay reglas paso un string vacio :)
       if(is_null($request->rules)) $rules = json_encode('empty');
       else $rules = $request->rules;
    
       $terapia->user_id = $usuario->id;
       $terapia->rules = $rules;
       $terapia->save(); 

       $array_per_raw = $request->input('periods'); //array con un elemento (con todos los elementos)

       //dd($array_per_raw);
       if (!empty($array_per_raw) && !is_null($array_per_raw) && !is_null($array_per_raw[0])) {
           $array_per = json_decode($array_per_raw[0], true);

           $periods_array = [];

           $period = [
               'duration_t1' => $array_per[0]['duration_t1'],
               'duration_t2' => $array_per[0]['duration_t2'],
               'duration_rest' => $array_per[0]['duration_rest'],
           ];
           
           array_push($periods_array, $period);
           
           array_shift($array_per); 
           
           foreach ($array_per as $per_indv) {
               $period = [
                   'duration_t1' => $per_indv['duration_t1'],
                   'duration_rest' => $per_indv['duration_rest']
               ];
               array_push($periods_array, $period);
           }
           $json_aray = json_encode($periods_array);

           //dd($periods_array);
           $session_period = new SessionPeriod;
           $session_period-> durations = $json_aray;
           $session_period-> therapy_id = $terapia->id;
           $session_period->save();
       }
       
       return redirect()->route('therapy_', ['id'=> $terapia->id])->with('success','Terapia creada correctamente');
    }

    public function show(string $id)
    {
        $therapy = Therapy::find($id);
        $periodo = SessionPeriod::where('therapy_id', $therapy->id)->first();
        return view('therapies.show_therapy',
         ['therapy' => $therapy, 'period' => $periodo]);
    }

    public function edit(string $id)
    {

    }
 
    public function showFormUpdate($id)
     {
        $therapy = Therapy::find($id);
        $patients_all = Patient::All();
        
     
        $periodo = SessionPeriod::where('therapy_id', $therapy->id)->first();
        $listaSesionesPeriods = [];
        $listaSesionesPeriods[] = $periodo->durations;
        $listaPer = json_encode($listaSesionesPeriods);
        return view('therapies.edit_therapy', ['patients_all' => $patients_all, 'therapy' => $therapy,'listaPer' => $listaPer]);
     }

     /*******/
    public function update(Request $request, $id)
    {
       $today = Carbon::now();
       echo $today->toDateTimeString();

       $request -> validate([
           'name' => 'max:255|required',
           'description' => 'max:255',
           'periods' => 'required|array|min:1',
           'rules' => ''
       ]);
       //dd($request->input('rules'));
       $terapia = Therapy::where('id', $id)->first();
       $terapia-> name = $request-> name;
      
       if(!Auth::check()){
        return view('layouts.app'); 
       }

       $usuario = Auth::user();


       //si no hay reglas paso un string vacio :)
       if(is_null($request->rules)) $rules = json_encode('empty');
       else $rules = $request->rules;
    
       $terapia->user_id = $usuario->id;
       $terapia->rules = $rules;
       $terapia->save(); 
       
       $array_per_raw = $request->input('periods');
       if (!is_null($array_per_raw) && !empty($array_per_raw) && !is_null($array_per_raw[0])) {
            $array_per = json_decode($array_per_raw[0], true);

            $periods_array = [];

            $period = [
                'duration_t1' => $array_per[0]['duration_t1'],
                'duration_t2' => $array_per[0]['duration_t2'],
                'duration_rest' => $array_per[0]['duration_rest'],
            ];
            
            array_push($periods_array, $period);
            
            array_shift($array_per); 
            
            foreach ($array_per as $per_indv) {
                $period = [
                    'duration_t1' => $per_indv['duration_t1'],
                    'duration_rest' => $per_indv['duration_rest']
                ];
                array_push($periods_array, $period);
            }
            $json_aray = json_encode($periods_array);

            //dd($periods_array);
            $session_period = $periodo = SessionPeriod::where('therapy_id', $terapia->id)->first();
            $session_period-> durations = $json_aray;
            $session_period->save();
        }
    
        return redirect()->route('therapy_show', ['id'=> $terapia->id])->with('success','Terapia creada correctamente');
    }
    public function destroy(string $id)
    {
         $therapy = Therapy::find($id); 
         $therapy->patients()->detach();
         $therapy->delete();
         $therapy = Therapy::all();
         return redirect()->route('therapies_index',['therapies' => $therapy])->with('success','Terapia eliminada correctamente');
   
    }
}
