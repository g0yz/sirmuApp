<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sede extends Model
{
    use HasFactory;

    const tipo_Campus = 'campus';
    const tipo_Virtual = 'virtual';
    const tipo_Regional = 'regional';
    const tipo_Especial = 'especial';

    public static $tipos = [
        self::tipo_Campus,
        self::tipo_Virtual,
        self::tipo_Regional,
        self::tipo_Especial,
    ];


    protected $table ='sedes';

        protected $fillable = [
        'nombre',
        'direccion',
        'tipo',
        'encargado_id',
        'capacidad_estudiantes',
        'carreras_ofrecidas'
    ];


    public function encargado(){
        return $this->belongsTo(User::class, 'encargado_id');
    }



}
