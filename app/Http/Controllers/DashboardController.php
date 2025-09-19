<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\DashboardController;

use App\Models\Sede;
use App\Models\Tarea;
use App\Models\User;



class DashboardController extends Controller{
    /**
     * @OA\Get(
     *   path="/dashboard/admin",
     *   summary="Dashboard del administrador",
     *   tags={"Dashboard"},
     *   security={{"sanctum":{}}},
     *   @OA\Response(
     *     response=200,
     *     description="Vista del dashboard del administrador"
     *   ),
     *   @OA\Response(
     *     response=403,
     *     description="Acceso denegado"
     *   )
     * )
     */
    public function admin()
    {
        if (Auth::user()->rol !== 'administrador') {
            abort(403, 'Acceso denegado');
        }

        $cantidadSedes = Sede::count();
        $tareasPendientes = Tarea::where('estado', 'pendiente')->count();
        $proximasTareas = Tarea::where('estado', 'pendiente')
                            ->orderBy('fecha_estimada', 'asc')
                            ->take(5)
                            ->get();

        return view('admin.dashboard', compact('cantidadSedes','tareasPendientes','proximasTareas'));

    }

    public function tecnico()
    {
        if (Auth::user()->rol !== 'tecnico') {
            abort(403, 'Acceso denegado');
        }

        return view('tecnico.dashboard');
        
    }

        public function encargado()
    {
        if (Auth::user()->rol !== 'encargado') {
            abort(403, 'Acceso denegado');
        }

        return view('encargado.dashboard');
    }

    public function auditor()
    {
        if (Auth::user()->rol !== 'auditor') {
            abort(403, 'Acceso denegado');
        }

        return view('auditor.dashboard');
    }

    public function soporteTecnico(){
        return view('soporteTecnico');
    }

}
