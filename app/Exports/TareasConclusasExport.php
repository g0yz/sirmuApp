<?php

namespace App\Exports;

use Illuminate\Support\Facades\Auth;
use App\Models\Tarea;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class TareasConclusasExport implements FromCollection, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $encargadoId = Auth::user()->id;

        return Tarea::with(['sede', 'encargado', 'tecnico'])
                ->whereIn('estado', ['validada', 'rechazada'])
                ->where('encargado_id', $encargadoId)
                ->orderBy('fecha_observacion', 'desc')
                ->get();



    }

    public function headings():array{
        return[
            'Titulo',
            'Tecnico',
            'Prioridad',
            'Tipo',
            'Estado',
            'Fecha Creacion',
            'Fecha Estimada',
            'Fecha Finalizacion',
            'Fecha Observacion',
        ];
    }


    
    public function map($tarea):array{

        $tecnicoNombre= $tarea->tecnico->persona->nombre;
        $tecnicoApellido= $tarea->tecnico->persona->apellido;
        $tecnico = trim($tecnicoNombre . ' ' . $tecnicoApellido);

        return[
            $tarea->titulo,
            $tecnico,
            $tarea->prioridad,
            $tarea->tipo,
            $tarea->estado,
            $tarea->fecha_creacion,
            $tarea->fecha_estimada,
            $tarea->fecha_finalizacion,
            $tarea->fecha_observacion,
        ];
    }






}
