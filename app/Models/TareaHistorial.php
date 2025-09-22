<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TareaHistorial extends Model
{
    protected $fillable = [
        'tarea_id',
        'usuario_id',
        'accion',
        'observacion',
    ];

    public function tarea()
    {
        return $this->belongsTo(Tarea::class);
    }

    public function usuario()
    {
        return $this->belongsTo(User::class);
    }
}
