<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Session;
use App\Models\Therapy;
use App\Models\SessionPeriod;
use App\Models\SessionData;

class SessionDataController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    //el json actualiza los datos para que el reloj al hacer el get vea una orden distinta y la ejecu
    public function sessionOrderUpdate(Request $request, string $id, string $order)
    {
        $session_data = SessionData::where('session_id', $id)->get();//should be only one
        $session_data[0]->order = $order;
        $session_data[0] -> save();
        dd($session_data);

        return response()->json([
            'success' => true,
            'message' => 'Session updated successfully'
        ]);
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
