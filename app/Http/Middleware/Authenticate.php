<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */

    
    protected function redirectTo(Request $request): ?string
    {
        return $request->expectsJson() ? null : route('main');
    }

    public function handle($request, Closure $next, ...$guards)
    {
        $guard = [
            '/session/response',
            '/start',
            '/finish',
            '/finishExtra',
            '/getrules',
            '/session/userdata/{id}'
        ];

        if(in_array($request -> path(), $guard)){
            return $next($request);
        }

        else if (!$this->auth->user())
        {
           return redirect()->route('login');
        }

        return $next($request);
    }
    
}
