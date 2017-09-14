<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class IsAdmin
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
        //check session to see if they are admin,
        //if they are return next request
        //else return 'access denied';
        if(Auth::user()->role == 'admin')
        {
            return $next($request);    
        }
        else
        {
            return 'access denied';    
        }
    }
}
