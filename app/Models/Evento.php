<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evento extends Model
{
    use HasFactory;
    static $rules = [
        'title' => 'required|max:255',
        'descripcion' => 'required',
        'start' => 'required|date',
        'end' => 'required|date|after_or_equal:start',
    ];

    protected $fillable = ['title', 'descripcion', 'start', 'end'];

}
