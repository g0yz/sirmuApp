<?php

namespace App\Models;
use Illuminate\Support\Facades\Auth;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

use App\Models\Evento;



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
            'resolucion_desc',
            'fecha_observacion',
            'observacion',
    ];

    protected static function booted()
    {
        static::creating(function ($tarea) {
            $tarea->fecha_creacion = now()->toDateString(); // YYYY-MM-DD
        });

//logica de los eventos junto a tareas
        static::created(function ($tarea) {
        // Cuando se cree la tarea, se crea un evento
            $tarea->evento()->create([
            'title' => $tarea->titulo,
            'descripcion' => $tarea->descripcion ?? 'Sin descripción',
            'start' => $tarea->fecha_creacion,
            'end' => $tarea->fecha_estimada,
            'user_id' => $tarea->encargado_id,
        ]);
    });

         static::updated(function ($tarea) {
        if ($tarea->evento) {
            $tarea->evento->update([
            'title' => $tarea->titulo,
            'descripcion' => $tarea->descripcion ?? 'Sin descripción',
            'start' => $tarea->fecha_creacion,
            'end' => $tarea->fecha_estimada,
            'user_id' => $tarea->encargado_id,
        ]);
    }
});

 static::deleting(function ($tarea) {
        // Opcional: eliminar evento al borrar tarea
        if ($tarea->evento) {
            $tarea->evento->delete();
        }
    });



}


    public function sede(){
        return $this->belongsTo(Sede::class, 'sede_id');
    }

    public function encargado(){
        return $this->belongsTo(User::class, 'encargado_id');
    }

    public function tecnico(){
        return $this->belongsTo(User::class, 'tecnico_id');
    }

    public function evento(){
        return $this->hasOne(Evento::class, 'tarea_id');
    }
    
    public $timestamps = false;



    //Definimos las collecciones de los archivos
    public function registerMediaCollections():void{

        $this->addMediaCollection('imagenes')
        ->acceptsMimeTypes(['image/jpeg','image/png'])
        ->useDisk('tareas_media');

         $this->addMediaCollection('documentos')
        ->acceptsMimeTypes(['application/pdf', // .pdf
            'application/msword', // .doc
            'application/vnd.openxmlformats-officedocument.wordprocessingml.document',  // .docx
            'application/vnd.ms-excel',  // .xls
            'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'])  // .xlsx
        ->useDisk('tareas_media');

        $this->addMediaCollection('documentos-resoluciones')
        ->acceptsMimeTypes(['application/pdf', // .pdf
            'application/msword', // .doc
            'application/vnd.openxmlformats-officedocument.wordprocessingml.document',  // .docx
            'application/vnd.ms-excel',  // .xls
            'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'])  // .xlsx
        ->useDisk('tareas_media');

        $this->addMediaCollection('imagenes-resoluciones')
        ->acceptsMimeTypes(['image/jpeg','image/png'])
        ->useDisk('tareas_media');

    }
       // Listar archivos de una colección
    public function listarArchivos(string $coleccion)
    {
        return $this->getMedia($coleccion);
    }

    // Eliminar un archivo específico
    public function eliminarArchivo(Media $media)
    {
        if ($media->model_id == $this->id && $media->model_type == self::class) {
            return $media->delete();
        }
        return false;
    }


}
