<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TherapyforumController extends Controller
{
    //
    public function show(string $id){
        return view('therapies.rules.rules', ['id' => $id]);
    }

    public function index(Request $request)
    {
        
    }

    public function uploadTherapy(Request $request, $id)
    {
        
    }

    public function downloadTherapy(Request $request, $id)
    {
        
    }

    public function deletePublishedTherapy(Request $request, $id)
    {
        
    }
}
