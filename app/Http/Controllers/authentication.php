<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class authentication extends Controller
{
    //

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
            
        if (Auth::attempt($credentials)) {
            return redirect()->intended('home'); // Redirecciona al dashboard o a la URL deseada
        }

        return redirect()->route('login') // Redirige de nuevo al formulario de inicio de sesión
            ->with('error', 'Credenciales inválidas'); // Puedes personalizar el mensaje de error
    }
}
