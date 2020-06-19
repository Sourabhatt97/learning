<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class allowadmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
     public function handle($request, Closure $next, $routerole)
    {
        $role = auth()->user()->role; 

        if($routerole == $role)
        {
            return $next($request);
        }  
        else
        {
            return back();
        }                  
    }
}
