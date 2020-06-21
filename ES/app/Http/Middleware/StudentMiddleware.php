<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class StudentMiddleware
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
        if(Auth::check())
        {
            $utype = Auth::user()->utype;
            if($utype != "Student"){
                return redirect('/dashboard');
            }
            else{
                return $next($request);
            }
        }else
        {
            return redirect('/login');
        }
  
    }
}
