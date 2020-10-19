<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RepMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (\Auth::guard('rep')->check()) 

        return $next($request);
        
        return redirect()->route('profile');

    }
}
