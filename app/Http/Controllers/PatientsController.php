<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\patient;
use App\Models\user;
use App\Models\Physiological;
use App\Models\Behavior;
use App\Models\Therapy;
use App\Models\Session;
use App\Models\patientevent;

class PatientsController extends Controller
{
    /**
     * INDEX: Muestra todos los elementos
     */
    public function index()
    {
        if (Auth::check()) {
            $usuario = Auth::user();
            $patients = Patient::where('user_id', $usuario -> id) -> get();
            return view('patients.patients', ['patients' => $patients]);
        }
        else{
            $patients = [];
            return view('patients.patients', ['patients' => $patients]);
        }
        //Para recordar que esto va asi $parameters = Parameter::all();
    }
     /**
     * STORE: Guarda un paciente
     */
     //Llega una solicitud http (del formulario de datps /crearPaciente)
     public function store(Request $request)
     {
        //Validaciones (de minimo x letras tal....)
        $request -> validate([
            'name' => 'required|min:1', //Al menos una letra para el nombre
            'surname' => 'min:1',
            'description' => 'max:255',
            'physiologicals' => 'array',
            'behaviors' => 'array'
        ]);
 
        if(!Auth::check()){
            return view('layouts.app'); 
        }

        $usuario = Auth::user();

        $patient = new Patient;
        $patient-> name = $request-> name;
        $patient-> surname = $request-> surname;
        $patient-> description = $request-> description;
        $user_login = user::where('id', $usuario -> id)->get();
        $patient-> user_id = $user_login[0]->id;
        $patient->save();

        $array_phy = $request->input('physiologicals');
        $array_beh = $request->input('behaviors');
        
        //Me llega un string del json con los valores y cojo los valores de cada sitio
        if (!empty($array_beh) && !is_null($array_beh) && !is_null($array_beh[0])) {
            foreach ($array_beh as $beh_indv) {
                $behavior = new Behavior;
                $array_behv = json_decode($beh_indv, true);
                $behavior-> type = $array_behv[0]['type'];
                $behavior-> description = $array_behv[0]['description'];
                $behavior-> patient_id = $patient->id;
                $behavior->save();
            }
        }

        if (!empty($array_phy) && !is_null($array_phy) && !is_null($array_phy[0])) {
            foreach ($array_phy as $phy_indv) {
                $physiological = new Physiological;

                $array_phys = json_decode($phy_indv, true);
    
                $physiological-> type = $array_phys[0]['type'];
                $physiological-> description = $array_phys[0]['description'];
                $physiological-> patient_id = $patient->id;
                $physiological->save();
            }
        }
        
        return redirect()->route('patients_index')->with('success','Paciente creado correctamente');
     }

     public function createObjective(string $patient_id)
     {
         $patient = patient::find($patient_id);
         $usuario = Auth::user();
         $therapiesList = Therapy::where('user_id',$usuario -> id)->get();
         $sessiones = Session::where('patient_id',$patient -> id)->get();
         $objectives = patientevent::where('patient_id', $patient->id) -> get();

         return view('patients.objectives.create_objective',  ['patient' => $patient, 'therapies' => $therapiesList, 'sessions'=> $sessiones, 'objectives' => $objectives, 'date_start' => "none"]);
     }

     public function storeObjective(Request $request,string $patient_id)
     {
        $request -> validate([
            'name' => 'required|min:1|max:20',
            'description' => 'max:255',
            'type' => 'required',
            'date_end' => 'required',
            'time_end' => 'required',
            'steps' => [
                'required'
            ],
        ]);   
        if (Auth::check()) {
            $usuario = Auth::user();
            $objective = new patientevent;

            $objective->name = $request -> name;
            $objective->type = $request -> type;
            $objective->description = $request -> description;

            $objective->date_end = $request -> date_end;
            $objective->time_end = $request -> time_end;
            
            $objective->steps = $request -> steps;

            $objective->user_id = $usuario->id;

            $objective->patient_id = $patient_id;

            $objective -> save();

            $patient = Patient::where('user_id', $usuario -> id)
                -> where('id', $patient_id)
                -> get();

            $sessions = Session::where('patient_id', $patient[0]->id) -> get();
            $objectives = patientevent::where('patient_id', $patient[0]->id) -> get();
            return view('patients.show_patient', ['patient' => $patient[0], 'sessions' => $sessions, 'objectives' => $objectives]);
        }
        else{
            $patients = [];
            return view('patients.patients', ['patients' => $patients]);
        }
     }

     public function avatar($id){
        if (Auth::check()) {
            $usuario = Auth::user();
            $patient = Patient::where('user_id', $usuario -> id)
                -> where('id', $id)
                -> get();
            if(!$patient)
                $patients = Patient::where('user_id', $usuario -> id) -> get();
            else{
                $sessions = Session::where('patient_id', $patient[0]->id) -> get();
                $objectives = patientevent::where('patient_id', $patient[0]->id) -> get();
                return view('patients.avatar.avatar', ['patient' => $patient[0]]);
            }
            return view('patients.patients', ['patients' => $patients]);
        }
        else{
            $patients = [];
            return view('patients.patients', ['patients' => $patients]);
        }
     }
     /**
      * SHOW: Muestra un paciente
      */

      public function show($id)
      {
        if (Auth::check()) {
            $usuario = Auth::user();
            $patient = Patient::where('user_id', $usuario -> id)
                -> where('id', $id)
                -> get();
            if(!$patient)
                $patients = Patient::where('user_id', $usuario -> id) -> get();
            else{
                $sessions = Session::where('patient_id', $patient[0]->id) -> get();
                $objectives = patientevent::where('patient_id', $patient[0]->id) -> get();
                return view('patients.show_patient', ['patient' => $patient[0], 'sessions' => $sessions, 'objectives' => $objectives]);
            }
            return view('patients.patients', ['patients' => $patients]);
        }
        else{
            $patients = [];
            return view('patients.patients', ['patients' => $patients]);
        }
      }
     /**
     * UPDATE: Actualiza un paciente
     */
     public function showFormUpdate($id)
     {
        return;
     }

     public function update(Request $request, $id)
     {
        $patient = Patient::find($id);
        $request -> validate([
            'name' => 'required|min:1', //Al menos una letra para el nombre
            'surname' => 'min:1',
            'description' => 'max:255'
        ]);

        if(!Auth::check()){
            return view('layouts.app'); 
        }

        $usuario = Auth::user();
        $patient-> name = $request-> name;
        $patient-> surname = $request-> surname;
        $patient-> description = $request-> description;

        //dd($patient);
        $patient->save();
        return redirect()->route('patient_show',  ['id' => $patient->id])->with('success','Paciente editado correctamente');
        
    }
     /**
     * DESTROY: eliminar pacienet
     */
    
     public function destroy($id)
     {
         $patient = Patient::find($id);
         $patient->delete();
         
         $patients = Patient::all();
         return redirect()->route('patients_index',['patients' => $patients])->with('success','Paciente eliminado correctamente');
     }

}
