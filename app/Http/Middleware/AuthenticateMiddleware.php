<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AuthenticateMiddleware
{
    public function handle($request, Closure $next)
    {
        if (!Auth::guard('web')->check()) {
            return redirect()->route('showLoginForm')->with('warning', 'Você precisa fazer login primeiro.');
        }

        return $next($request);
    }
}
