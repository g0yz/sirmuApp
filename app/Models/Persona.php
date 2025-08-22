<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use App\Models\Usuario;


class Persona extends Model
{
    use HasFactory;

    protected $table = 'personas';

        protected $fillable = [
        'nombre',
        'apellido',
        'usuario_id',
    ];


    public function usuario(){
        return $this->belongsTo(Usuario::class, 'usuario_id');

    }


}
