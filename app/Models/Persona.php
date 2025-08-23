<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use App\Models\User;


class Persona extends Model
{
    use HasFactory;

    protected $table = 'personas';

        protected $fillable = [
        'nombre',
        'apellido',
        'user_id',
    ];


    public function usuario(){
        return $this->belongsTo(User::class, 'user_id');

    }


}
