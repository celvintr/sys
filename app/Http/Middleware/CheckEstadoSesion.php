<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class CheckEstadoSesion
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
        if ($request->user()->estado_sesion == 0
            && Route::currentRouteName() != 'admin.auth.password'
            && Route::currentRouteName() != 'admin.auth.password.update') {

            return redirect()->route('admin.auth.password');
        }

        return $next($request);
    }
}
