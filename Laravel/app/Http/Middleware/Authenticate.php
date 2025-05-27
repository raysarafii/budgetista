<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Authenticate
{
    public function handle($request, Closure $next, ...$guards)
    {
        if (empty($guards)) {
            if (!Auth::check()) {
                return redirect()->route('login');
            }
        } else {
            foreach ($guards as $guard) {
                if (Auth::guard($guard)->check()) {
                    return $next($request);
                }
            }
        }

        return $next($request);
    }
}
