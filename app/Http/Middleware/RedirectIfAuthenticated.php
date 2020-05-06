<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {

        /// lorsque vous vous connecter avec l'existance d'une session

        if (    $guard === "secretaire" && Auth::guard($guard)->check()) {  /// $guard === "secretaire"
            return redirect('/');
        }
        if ( $guard === "medcin" && Auth::guard($guard)->check()) {
            return redirect('/');
        }
         if ( $guard === "admin" && Auth::guard($guard)->check()) {
             return redirect('/');
         }
        if (Auth::guard($guard)->check()) {
            return redirect('/');
        }

        return $next($request);
    }
}