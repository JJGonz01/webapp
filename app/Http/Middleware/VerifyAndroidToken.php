<?php

namespace App\Http\Middleware;
use Closure;
use Illuminate\Http\Request;
use \Firebase\JWT\JWT; 
use Firebase\JWT\Key;
use Illuminate\Auth\Middleware\Authenticate as Middleware;

use Illuminate\Support\Facades\Auth;


class VerifyAndroidToken extends Middleware{

    public function handle($request, Closure $next, ...$guards)
    {
        $token = $request->header('Authorization');

        $guard = [
            '/session/response',
            '/start',
            '/finish',
            '/finishExtra',
            '/getrules'
        ];
        
        $auth = [
            '/login',
            '/login?'
        ];

        
        if(!in_array($request -> path(), $guard)){ /*No es una ruta a la que haya que aplicar el middleware*/
            return $next($request);
        }

        if (!$token) {//modificar
            return response()->json(['error' => 'Token no proporcionado'], 401);
        }

        $secretKey = env('ANDROID_TOKEN_KEY', '');

        $secret = base64_decode($secretKey);
        
        try {
            $decoded = JWT::decode($token, new Key($secret, 'HS256'));
            return $next($request);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Token inválidso',$e->getMessage()], 401);
        }
    }

}
