<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Tarea;


class TareaController extends Controller
{
  
    
    public function index() {
    $tareas = Tarea::with(['sede', 'encargado', 'tecnico'])->get();
    return view('tareas.index', compact('tareas'));


}







    
}
