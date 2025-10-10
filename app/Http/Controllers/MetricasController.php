<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Tarea;

use Carbon\Carbon;

class MetricasController extends Controller{


    public function metricasDelMes(){

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
    

}
