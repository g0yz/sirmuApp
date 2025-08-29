<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{

public function handle(Request $request, Closure $next, ...$roles)
{
    if(!Auth::check()){
        return redirect('/login');
    }

    // Verifica si el rol del usuario está en los permitidos
    if(!in_array(Auth::user()->rol, $roles)){
        abort(403, 'Acceso denegado');
    }

    return $next($request);
}


}
