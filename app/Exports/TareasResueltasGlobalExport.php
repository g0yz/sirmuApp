<?php

namespace App\Exports;

use App\Models\Tarea;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;



class TareasResueltasGlobalExport implements FromCollection, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Tarea::with(['sede', 'encargado', 'tecnico'])
            ->whereIn('estado', ['validada', 'rechazada'])
            ->orderBy('fecha_observacion', 'desc')
            ->get();
    }

    public function headings():array{
        return[
            'Titulo',
            'Sede',
            'Encargado',
            'Prioridad',
            'Tipo',
            'Estado',
            'Fecha Creacion',
            'Fecha Finalizacion',
            'Fecha Observacion',
        ];
    }

    public function map($tarea):array{

        $encargadoNombre= $tarea->encargado->persona->nombre;
        $encargadoApellido= $tarea->encargado->persona->apellido;
        $encargado = trim($encargadoNombre . ' ' . $encargadoApellido);

        return[
            $tarea->titulo,
            $tarea->sede->nombre,
            $encargado,
            $tarea->prioridad,
            $tarea->tipo,
            $tarea->estado,
            $tarea->fecha_creacion,
            $tarea->fecha_finalizacion,
            $tarea->fecha_observacion,
        ];
    }

}
