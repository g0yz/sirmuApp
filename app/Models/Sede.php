<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Sede extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

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


    // Relación: una sede tiene muchas tareas
    public function tareas()
    {
        return $this->hasMany(Tarea::class, 'sede_id', 'id_sede');
    }

    // Relación Sede con el encargado
    public function encargado(){
        return $this->belongsTo(User::class, 'encargado_id');
    }

    public $timestamps = false;


        public function registerMediaCollections(): void{
        $this->addMediaCollection('imagenes')
            ->useDisk('sedes_media')
            ->singleFile(); // solo se agrega una imagen por sede
    }

}
