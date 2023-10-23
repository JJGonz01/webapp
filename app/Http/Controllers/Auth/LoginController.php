<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller; 
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

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
