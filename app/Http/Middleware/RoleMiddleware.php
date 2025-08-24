<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{

    public function handle(Request $request, Closure $next): Response
    {
        if(!Auth::check()){
            return redirect('/login');
        }

        if(Auth::user()->rol !== 'administrador'){
            abort(403,'acceso denegado');
        }

        if(Auth::user()->rol !== 'tecnico'){
            abort(403,'acceso denegado');
        }
        
        if(Auth::user()->rol != 'encargado'){
            abort(403,'acceso denegado');
        }

        if(Auth::user()->rol != 'auditor'){
            abort(403,'acceso denegado');
        }

        return $next($request);
    }

}
