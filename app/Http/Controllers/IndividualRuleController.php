<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ReglaIndividual;
class IndividualRuleController extends Controller
{
    //
    public function create($id)
    {
        return view('therapies.rules.rule_creation', ['id'=> $id]);
    }

     
    public function store(Request $request, string $id)
    {
        $request -> validate([
            'conjuntoPeriodo' =>'required|unique:sessions|date_format:Y-m-d\TH:i|after_or_equal:' . $today,
            'periodo' => 'max:255',
            'momentoPeriodo' => 'max:255',
            'condiciones' => 'required|array|min:1',
            'accion1' => 'max:255',
            'accion2' => 'max:255',
            'ruleset_id' => 'max:255',
        ]);

        $rule = new ReglaIndividual;
        $rule -> conjuntoPeriodo = $request -> conjuntoPeriodo;
        $rule -> periodo = $request -> periodo;
        $rule -> momentoPeriodo = $request -> momentoPeriodo;
        $rule -> condiciones = $request -> condiciones;
        $rule -> accion1 = $request -> accion1;
        $rule -> accion2 = $request -> accion2;
        $rule -> ruleset_id = $request -> ruleset_id;
        $rule -> save();

        return redirect()->route('rules_create', ['id'=> $id])->with('success','Sesion creado correctamente');

    }
}
