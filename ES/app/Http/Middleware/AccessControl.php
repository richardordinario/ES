<?php

namespace App\Http\Middleware;

use Closure;
use Session;
use Redirect;

class AccessControl
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
        if(Session::has('adminsession'))
        {
            return Redirect::to('dashboard');
        }
        else
        {
            return $next($request);
        }
    }
}
