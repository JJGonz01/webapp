<?php

namespace App\Http\Controllers;


use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\clock_message;
class Clock_messageController extends Controller
{
    public function index(Request $request){
        if (Auth::check()) {
            $usuario = Auth::user();
            $messages = clock_message::where('user_id', $usuario -> id) -> get();
            return view('therapies.therapies', ['therapies' => $messages]);
        }
        else{
            $messages = [];
            return view('therapies.therapies', ['therapies' => $messages]);
        }
    }

    public function indexall(Request $request){
        if (Auth::check()) {
            $usuario = Auth::user();
            $messages = clock_message::where('user_id', $usuario -> id) -> get();
            return $messages;
        }
        else{
            $messages = [];
            return $messages;
        }
    }

    public function store(Request $request)
    {
       
        $request -> validate([
            'name' => 'required',
            'title' => 'required',
            'subtitle' => 'required',
            'button_one' => 'max:255',
            'button_two' => 'max:255',
            'type' =>'required',
            'image'=>'required'
        ]);
        
        if(!Auth::check()){
            return view('layouts.app'); 
        }
        
        $usuario = Auth::user();
        
        $message = new clock_message;
        $message-> name = $request-> name;
        $message-> title = $request-> title;
        $message-> subtitle = $request-> subtitle;
        $message-> button_one = $request-> button_one;
        $message-> button_two = $request-> button_two;
        $message-> type = $request-> type;
        $message-> image = $request-> image;
        //$user_login = user::where('id', $usuario -> id)->get();return [];
        $message-> user_id = $usuario->id;
        $message->save();

        return $message;
    }
}