<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class checkstatus
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
        $status = Auth::user()->status;

        if($status == "enable")
        {
            return $next($request);
        }

        else
        {
            Auth::logout();
            return back()->with("message","Your Account has been deleted You cant login with this credentials");
        }
    }
}
