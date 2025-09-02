<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SoporteTecnicoController;
use App\Http\Controllers\ConfiguracionController;
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
Route::get('/admin/inicio', [DashboardController::class, 'admin'])->name('admin.dashboard')->middleware('rol:administrador');
//Tecnico
Route::get('/tecnico/inicio', [DashboardController::class, 'tecnico'])->name('tecnico.dashboard')->middleware('rol:tecnico');
//Encargado
Route::get('/encargado/inicio', [DashboardController::class, 'encargado'])->name('encargado.dashboard')->middleware('rol:encargado');
//Auditor
Route::get('/auditor/inicio', [DashboardController::class, 'auditor'])->name('auditor.dashboard')->middleware('rol:auditor');

//ROLES SoporteTecnico
//Administrador
Route::get('/admin/soporte-tecnico', [SoporteTecnicoController::class, 'index'])->name('admin.soporteTecnico')->middleware('rol:administrador');
//Tecnico
Route::get('/tecnico/soporte-tecnico', [SoporteTecnicoController::class, 'index'])->name('tecnico.soporteTecnico')->middleware('rol:tecnico');
//Encargado
Route::get('/encargado/soporte-tecnico', [SoporteTecnicoController::class, 'index'])->name('encargado.soporteTecnico')->middleware('rol:encargado');
//Auditor
Route::get('/auditor/soporte-tecnico', [SoporteTecnicoController::class, 'index'])->name('auditor.soporteTecnico')->middleware('rol:auditor');

//ROLES Configuracion
//Administrador
Route::get('/admin/configuracion', [ConfiguracionController::class, 'index'])->name('admin.configuracion')->middleware('rol:administrador');
//Tecnico
Route::get('/tecnico/configuracion', [ConfiguracionController::class, 'index'])->name('tecnico.configuracion')->middleware('rol:tecnico');
//Encargado
Route::get('/encargado/configuracion', [ConfiguracionController::class, 'index'])->name('encargado.configuracion')->middleware('rol:encargado');
//Auditor
Route::get('/auditor/configuracion', [ConfiguracionController::class, 'index'])->name('auditor.configuracion')->middleware('rol:auditor');








//Rutas Administrador//
//Listar todos los usuarios
Route::get('/admin/gestionar-usuarios', [UserController::class, 'index'])->name('usuarios.index')->middleware('rol:administrador');
//formulario para crear un nuevo usuario
Route::get('/admin/usuarios/crear-usuario', [UserController::class, 'create'])->name('usuarios.create')->middleware('rol:administrador');
// Guardar nuevo usuario
Route::post('/admin/guardar-usuario', [UserController::class, 'store'])->name('usuarios.store')->middleware('rol:administrador');
// Mostrar detalles de un usuaurio
Route::get('/admin/detallar-usuario/{user}', [UserController::class, 'show'])->name('usuarios.show')->middleware('rol:administrador');
//formulario para editar un usuario
Route::get('/admin/usuarios/{user}/editar-usuario', [UserController::class, 'edit'])->name('usuarios.edit')->middleware('rol:administrador');
// Actualizar un usuario
Route::put('/admin/actualizar-usuario/{user}', [UserController::class, 'update'])->name('usuarios.update')->middleware('rol:administrador');
// Eliminar un usuario
Route::delete('/admin/eliminar-usuario/{user}', [UserController::class, 'destroy'])->name('usuarios.destroy')->middleware('rol:administrador');

// Listar todas las sedes
Route::get('/admin/gestionar-sedes', [SedeController::class, 'index'])->name('sedes.index')->middleware('rol:administrador');
//formulario para crear una nueva sede
Route::get('/admin/sedes/crear-sede', [SedeController::class, 'create'])->name('sedes.create')->middleware('rol:administrador');
// Guardar nueva sede
Route::post('/admin/guardar-sede', [SedeController::class, 'store'])->name('sedes.store')->middleware('rol:administrador');
// Mostrar detalles de una sede
Route::get('/admin/detallar-sede/{sede}', [SedeController::class, 'show'])->name('sedes.show')->middleware('rol:administrador');
//formulario para editar una sede
Route::get('/admin/sedes/{sede}/editar-sede', [SedeController::class, 'edit'])->name('sedes.edit')->middleware('rol:administrador');
// Actualizar una sede
Route::put('/admin/actualizar-sede/{sede}', [SedeController::class, 'update'])->name('sedes.update')->middleware('rol:administrador');
// Eliminar una sede
Route::delete('/admin/eliminar-sede/{sede}', [SedeController::class, 'destroy'])->name('sedes.destroy')->middleware('rol:administrador');


// Listar todas las tareas
Route::get('/admin/gestionar-tareas', [TareaController::class, 'index'])->name('tareas.index')->middleware('rol:administrador');
//formulario para crear una nueva tarea
Route::get('/admin/tareas/crear-tarea', [TareaController::class, 'create'])->name('tareas.create')->middleware('rol:administrador');
// Guardar nueva sede
Route::post('/admin/guardar-tarea', [TareaController::class, 'store'])->name('tareas.store')->middleware('rol:administrador');
// Mostrar detalles de una tarea
Route::get('/admin/detallar-tarea/{tarea}', [TareaController::class, 'show'])->name('tareas.show')->middleware('rol:administrador');
//formulario para editar una tarea
Route::get('/admin/tareas/{tarea}/editar-tarea', [TareaController::class, 'edit'])->name('tareas.edit')->middleware('rol:administrador');
// Actualizar un tarea
Route::put('/admin/actualizar-tarea/{tarea}', [TareaController::class, 'update'])->name('tareas.update')->middleware('rol:administrador');
// Eliminar una tarea
Route::delete('/admin/eliminar-tarea/{tarea}', [TareaController::class, 'destroy'])->name('tareas.destroy')->middleware('rol:administrador');


//Rutas Tecnico//




