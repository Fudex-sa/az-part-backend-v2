<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Session;

class isLogged
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
        if ( auth()->guard('seller')->check() || auth()->guard('broker')->check() ||
            auth()->guard('company')->check() || auth()->guard('rep')->check()
            || auth()->guard('admin')->check() ||  auth()->check()) 

            return $next($request);
        
        else{
            
            if(session()->get('has_request'))

                Session::put('search',[
                    'brand' => $request->brand , 'model' => $request->model ,
                    'year' => $request->year , 'country' => $request->country ,
                    'region' => $request->region , 'city' => $request->city ,
                    'search_type' => $request->search_type 
                ]);
  
            return redirect()->route('user.signin');
        }
    }

    
}
