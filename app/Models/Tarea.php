<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tarea extends Model
{
    //

        const tipo_Mantenimiento = 'mantenimiento';
        const tipo_Presupuesto = 'presupuesto';
        const tipo_Instalacion = 'instalacion';
        
        const prioridad_Alta = 'alta';
        const prioridad_Media = 'media';
        const prioridad_Baja = 'baja';

        const estado_Pendiente = 'pendiente';
        const estado_Finalizado = 'finalizado';
        const estado_Validado = 'validado';
        const estado_Rechazado = 'rechazado';

        public static $tipos = [
            self::tipo_Mantenimiento,
            self::tipo_Presupuesto,
            self::tipo_Instalacion,
        ];

        public static $prioridades = [
            self::prioridad_Alta,
            self::prioridad_Media,
            self::prioridad_Baja,
        ];

        public static $estados = [
            self::estado_Pendiente,
            self::estado_Finalizado,
            self::estado_Validado,
            self::estado_Rechazado,
        ];

        protected $table ='tareas';

        protected $fillable = [
            'sede_id',
            'encargado_id',
            'tecnico_id',
            'titulo',
            'prioridad',
            'tipo',
            'estado',
            'descripcion',
            'fecha_creacion',
            'fecha_estimada',
            'fecha_finalizacion',
    ];

    public function sede()
    {
        return $this->belongsTo(Sede::class, 'sede_id');
    }

    public function encargado()
    {
        return $this->belongsTo(User::class, 'encargado_id');
    }

    public function tecnico()
    {
        return $this->belongsTo(User::class, 'tecnico_id');
    }

    public $timestamps = false;

}
