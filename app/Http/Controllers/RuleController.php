<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RuleController extends Controller
{
    //
   public function show(string $id){
    return view('therapies.rules.rules', ['id' => $id]);
   }
}
