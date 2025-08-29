<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SedeController;
use App\Http\Controllers\TareaController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');// Mostrar formulario login
Route::post('/login', [AuthController::class, 'login'])->middleware('guest'); // Procesar login
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register'); // Mostrar formulario registro
Route::post('/register', [AuthController::class, 'register'])->middleware('guest');  // Procesar registro
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


//ROLES Dashboards
//Administrador
Route::get('/admin', [DashboardController::class, 'admin'])->name('admin.dashboard')->middleware('rol:administrador');
//Tecnico
Route::get('/tecnico', [DashboardController::class, 'tecnico'])->name('tecnico.dashboard')->middleware('rol:tecnico');
//Encargado
Route::get('/encargado', [DashboardController::class, 'encargado'])->name('encargado.dashboard')->middleware('rol:encargado');
//Auditor
Route::get('/auditor', [DashboardController::class, 'auditor'])->name('auditor.dashboard')->middleware('rol:auditor');



//Ruta Admin
//Listar todos los usuarios
Route::get('/admin/usuarios', [UserController::class, 'index'])->name('usuarios.index')->middleware('rol:administrador');
//formulario para crear un nuevo usuario
Route::get('/admin/usuarios/create', [UserController::class, 'create'])->name('usuarios.create')->middleware('rol:administrador');
// Guardar nuevo usuario
Route::post('/admin/usuarios', [UserController::class, 'store'])->name('usuarios.store')->middleware('rol:administrador');
// Mostrar detalles de un usuaurio
Route::get('/admin/usuarios/{usuario}', [UserController::class, 'show'])->name('usuarios.show')->middleware('rol:administrador');
//formulario para editar un usuario
Route::get('/admin/usuarios/{usuario}/edit', [UserController::class, 'edit'])->name('usuarios.edit')->middleware('rol:administrador');
// Actualizar un usuario
Route::put('/admin/usuarios/{usuario}', [UserController::class, 'update'])->name('usuarios.update')->middleware('rol:administrador');
// Eliminar un usuario
Route::delete('/admin/usuarios/{usuario}', [UserController::class, 'destroy'])->name('usuarios.destroy')->middleware('rol:administrador');

//Rutas Sedes
// Listar todas las sedes
Route::get('/sedes', [SedeController::class, 'index'])->name('sedes.index');
//formulario para crear una nueva sede
Route::get('/sedes/create', [SedeController::class, 'create'])->name('sedes.create');
// Guardar nueva sede
Route::post('/sedes', [SedeController::class, 'store'])->name('sedes.store');
// Mostrar detalles de una sede
Route::get('/sedes/{sede}', [SedeController::class, 'show'])->name('sedes.show');
//formulario para editar una sede
Route::get('/sedes/{sede}/edit', [SedeController::class, 'edit'])->name('sedes.edit');
// Actualizar una sede
Route::put('/sedes/{sede}', [SedeController::class, 'update'])->name('sedes.update');
// Eliminar una sede
Route::delete('/sedes/{sede}', [SedeController::class, 'destroy'])->name('sedes.destroy');

//Rutas Tareas
// Listar todas las tareas
Route::get('/tareas', [TareaController::class, 'index'])->name('tareas.index');
//formulario para crear una nueva tarea
Route::get('/tareas/create', [TareaController::class, 'create'])->name('tareas.create');
// Guardar nueva sede
Route::post('/tareas', [TareaController::class, 'store'])->name('tareas.store');
// Mostrar detalles de una tarea
Route::get('/tareas/{tarea}', [TareaController::class, 'show'])->name('tareas.show');
//formulario para editar una tarea
Route::get('/tareas/{tarea}/edit', [TareaController::class, 'edit'])->name('tareas.edit');
// Actualizar un tarea
Route::put('/tareas/{tarea}', [TareaController::class, 'update'])->name('tareas.update');
// Eliminar una tarea
Route::delete('/tareas/{tarea}', [TareaController::class, 'destroy'])->name('tareas.destroy');

