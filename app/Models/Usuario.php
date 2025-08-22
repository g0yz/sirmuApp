<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Persona;

class Usuario extends Authenticatable
{
    use HasFactory;

    protected $table = 'usuarios';

    const ROL_ADMIN = 'administrador';
    const ROL_TECNICO = 'tecnico';
    const ROL_ENCARGADO = 'encargado';
    const ROL_AUDITOR = 'auditor';

    protected $fillable = [
        'email',
        'password',
        'rol',
    ];

    protected $hidden =[
        'password',
    ];

    public function getAuthPassword(){

        return $this->password;
    }

    public function setPasswordAttribute($value){
        $this->attributes['password']=bcrypt($value);

    }

    public $timestamps = false;

    public function persona(){
        return $this->hasOne(Persona::class, 'usuario_id');
    }


}
