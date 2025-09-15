<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;



class Tarea extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;
    //

        const tipo_Mantenimiento = 'mantenimiento';
        const tipo_Presupuesto = 'presupuesto';
        const tipo_Instalacion = 'instalacion';
        
        const prioridad_Alta = 'alta';
        const prioridad_Media = 'media';
        const prioridad_Baja = 'baja';

        const estado_Pendiente = 'pendiente';
        const estado_Finalizado = 'finalizada';
        const estado_Validado = 'validada';
        const estado_Rechazado = 'rechazada';

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


    protected static function booted()
    {
        static::creating(function ($tarea) {
            $tarea->fecha_creacion = now()->toDateString(); // YYYY-MM-DD
        });
    }


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



    //Definimos las collecciones de los archivos
    public function registerMediaCollections():void{

        $this->addMediaCollection('imagenes')
        ->acceptsMimeTypes(['image/jpeg','image/png'])
        ->useDisk('tareas_media');

         $this->addMediaCollection('documentos')
        ->acceptsMimeTypes(['application/pdf','application/docx'])
        ->useDisk('tareas_media');
    }

        // Subir archivo a una colección
    public function agregarArchivo($archivo, string $coleccion){
        return $this->addMedia($archivo)
                    ->toMediaCollection($coleccion, 'tareas_media');
    }

       // Listar archivos de una colección
    public function listarArchivos(string $coleccion)
    {
        return $this->getMedia($coleccion);
    }

    // Obtener URLs de los archivos de una colección
    public function urlsArchivos(string $coleccion)
    {
        return $this->getMedia($coleccion)->map(fn($media) => $media->getUrl());
    }

    // Eliminar un archivo específico
    public function eliminarArchivo(Media $media)
    {
        if ($media->model_id == $this->id && $media->model_type == self::class) {
            return $media->delete();
        }
        return false;
    }

    // Eliminar todos los archivos de una colección
    public function eliminarArchivosColeccion(string $coleccion)
    {
        $this->clearMediaCollection($coleccion);
    }

}
