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
        
        return $next($request); #TODO
        $token = $request->header('Authorization');
        $guard = [
            '/session/response',
            '/start',
            '/finish',
            '/finishExtra',
            '/getrules',
            '/session/userdata/',
            '/session/userdata/1'
        ];
        
        if(!in_array($request -> path(), $guard)){ /*No es una ruta a la que haya que aplicar el middleware de petición android studio*/
            return $next($request);
            return response()->json(['error' => 'Error con eltoken origen'], 401);
        }

        if (!$token) {//modificar
            return response()->json(['error' => 'Error al confirmar origen'], 401);
        }

        $secretKey = "aaa";// env('ANDROID_TOKEN_KEY', '');

        $secret = base64_decode($secretKey);
        
        try {
            $decoded = JWT::decode($token, new Key($secret, 'HS256'));
            return $next($request);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Token inválidso',$e->getMessage()], 401);
        }
    }

}
