<?php

namespace App\Http\Middleware;

use Closure;

class AuthAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!\Auth::user()) {
            return redirect()->route('login');
        }

        if (\Auth::user() && \Auth::user()->role_id == 1) {
            return redirect()->route('home');
        }

        return $next($request);
    }
}
