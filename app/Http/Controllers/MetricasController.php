<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Tarea;

use Carbon\Carbon;

class MetricasController extends Controller{


    public function metricasDelMesAuditor(){

        $anioActual = Carbon::now()->year;
        $mesActual = now()->month;

        $pendientes = Tarea::whereYear('fecha_creacion', $anioActual)
            ->whereMonth('fecha_creacion', $mesActual)
            ->where('estado', Tarea::estado_Pendiente)
            ->count();

        $finalizadas = Tarea::whereYear('fecha_finalizacion', $anioActual)
            ->whereMonth('fecha_finalizacion', $mesActual)
            ->where('estado', Tarea::estado_Finalizado)
            ->count();

        $validadas = Tarea::whereYear('fecha_observacion', $anioActual)
            ->whereMonth('fecha_observacion', $mesActual)
            ->where('estado', Tarea::estado_Validado)
            ->count();

        $rechazadas = Tarea::whereYear('fecha_observacion', $anioActual)
            ->whereMonth('fecha_observacion', $mesActual)
            ->where('estado', Tarea::estado_Rechazado)
            ->count();

        $totales = $pendientes + $finalizadas + $validadas + $rechazadas;

        return view('auditor.metricas.proyeccion', compact('pendientes','finalizadas','validadas', 'rechazadas', 'totales', 'mesActual'));

    }
    

    
    public function metricasDelMesEncargado(){

    $user = auth()->id();

    $anioActual = now()->year;
    $mesActual = now()->month;

    // Tareas pendientes del encargado (solo su sede)
    $pendientes = Tarea::where('encargado_id', $user)
        ->whereYear('fecha_creacion', $anioActual)
        ->whereMonth('fecha_creacion', $mesActual)
        ->where('estado', Tarea::estado_Pendiente)
        ->count();

    // Tareas finalizadas del encargado
    $finalizadas = Tarea::where('encargado_id', $user)
        ->whereYear('fecha_finalizacion', $anioActual)
        ->whereMonth('fecha_finalizacion', $mesActual)
        ->where('estado', Tarea::estado_Finalizado)
        ->count();

    // Tareas validadas del encargado
    $validadas = Tarea::where('encargado_id', $user)
        ->whereYear('fecha_observacion', $anioActual)
        ->whereMonth('fecha_observacion', $mesActual)
        ->where('estado', Tarea::estado_Validado)
        ->count();

    // Tareas rechazadas del encargado
    $rechazadas = Tarea::where('encargado_id', $user)
        ->whereYear('fecha_observacion', $anioActual)
        ->whereMonth('fecha_observacion', $mesActual)
        ->where('estado', Tarea::estado_Rechazado)
        ->count();

    $totales = $pendientes + $finalizadas + $validadas + $rechazadas;

    // Pasamos los datos a la vista del encargado
    return view('encargado.metricas.proyeccion', compact('pendientes','finalizadas','validadas','rechazadas','totales','mesActual'));
}

}
