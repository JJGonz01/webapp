<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\patient;
use App\Models\user;
use App\Models\Physiological;
use App\Models\Behavior;

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

        
        if (!empty($array_beh) && !is_null($array_beh) && !is_null($array_beh[0])) {
            foreach ($array_beh as $beh_indv) {
                $behavior = new Behavior;
                
                //Me llega un string del json con los valores y cojo los valores de cada sitio
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

     /**
      * SHOW: Muestra un paciente
      */

      public function show($id)
      {
          $patient = Patient::find($id);
          $sessiones = $patient->session;
          return view('patients.show_patient', ['patient' => $patient, 'sessions'=> $sessiones]);
      }
     /**
     * UPDATE: Actualiza un paciente
     */

     public function showFormUpdate($id)
     {
        $patient = Patient::find($id);
        return view('patients.edit_patient', ['patient' => $patient]);
     }

     public function update(Request $request, $id)
    {
        $patient = Patient::find($id);
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
