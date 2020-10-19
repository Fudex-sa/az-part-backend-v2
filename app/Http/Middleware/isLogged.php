<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Session;
use App\Helpers\Search;

class isLogged
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */

    protected $search;

    public function __construct()
    {     
        $this->search = new Search();
    }

    public function handle(Request $request, Closure $next)
    {
        if ( auth()->guard('seller')->check() || auth()->guard('broker')->check() ||
            auth()->guard('company')->check() || auth()->guard('rep')->check()
            || auth()->guard('admin')->check() ||  auth()->check()) 

            return $next($request);
        
        else{
            
            $this->search->save_search($request);
  
            return redirect()->route('user.signin');
        }
    }

    
}
