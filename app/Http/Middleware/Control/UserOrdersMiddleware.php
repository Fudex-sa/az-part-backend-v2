<?php

namespace App\Http\Middleware\Control;

use Closure;
use Illuminate\Http\Request;

class UserOrdersMiddleware
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
        if (auth()->guard('seller')->check() || auth()->guard('broker')->check() || 
            auth()->guard()->check() || auth()->guard('company')->check()) 

            return $next($request);
            
        return redirect()->route('profile');
    }
}
