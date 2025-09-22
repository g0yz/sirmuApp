<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
   
     use HasFactory;

    protected $table = 'users';

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

    public $timestamps = false;

    public function persona(){
        return $this->hasOne(Persona::class, 'user_id');
    }

    public function sede(){
        return $this->hasOne(Sede::class, 'encargado_id');
    }




}
