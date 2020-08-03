<?php

namespace App\Http\Middleware;
use Auth;
use Closure;

class SuperAdminMiddleware
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
        if(Auth::user()->role == 1)
        {
            return $next($request);
        }
        else
        {
            return redirect('/dashboard');
        }
    }
}
