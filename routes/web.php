<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SoporteTecnicoController;
use App\Http\Controllers\ConfiguracionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SedeController;
use App\Http\Controllers\TareaController;
use App\Http\Controllers\EventoController;

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
Route::post('/admin/soporte-tecnico', [SoporteTecnicoController::class, 'enviar'])->name('soporteTecnico.enviar');
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
Route::middleware([])->group(function () {
    Route::put('/configuracion/perfil', [ConfiguracionController::class, 'updatePerfil'])->name('config.update.profile');
    Route::put('/configuracion/password', [ConfiguracionController::class, 'updatePassword'])->name('config.update.password');
});

//Rutas Administrador//
//Listar todos los usuarios
Route::get('/admin/gestionar-usuarios', [UserController::class, 'index'])->name('admin.usuarios.index')->middleware('rol:administrador');
//formulario para crear un nuevo usuario
Route::get('/admin/usuarios/crear-usuario', [UserController::class, 'create'])->name('admin.usuarios.create')->middleware('rol:administrador');
// Guardar nuevo usuario
Route::post('/admin/guardar-usuario', [UserController::class, 'store'])->name('admin.usuarios.store')->middleware('rol:administrador');
// Mostrar detalles de un usuaurio
Route::get('/admin/detallar-usuario/{user}', [UserController::class, 'show'])->name('admin.usuarios.show')->middleware('rol:administrador');
//formulario para editar un usuario
Route::get('/admin/usuarios/{user}/editar-usuario', [UserController::class, 'edit'])->name('admin.usuarios.edit')->middleware('rol:administrador');
// Actualizar un usuario
Route::put('/admin/actualizar-usuario/{user}', [UserController::class, 'update'])->name('admin.usuarios.update')->middleware('rol:administrador');
// Eliminar un usuario
Route::delete('/admin/eliminar-usuario/{user}', [UserController::class, 'destroy'])->name('admin.usuarios.destroy')->middleware('rol:administrador');

// Listar todas las sedes
Route::get('/admin/gestionar-sedes', [SedeController::class, 'index'])->name('admin.sedes.index')->middleware('rol:administrador');
//formulario para crear una nueva sede
Route::get('/admin/sedes/crear-sede', [SedeController::class, 'create'])->name('admin.sedes.create')->middleware('rol:administrador');
// Guardar nueva sede
Route::post('/admin/guardar-sede', [SedeController::class, 'store'])->name('admin.sedes.store')->middleware('rol:administrador');
// Mostrar detalles de una sede
Route::get('/admin/detallar-sede/{sede}', [SedeController::class, 'show'])->name('admin.sedes.show')->middleware('rol:administrador');
//formulario para editar una sede
Route::get('/admin/sedes/{sede}/editar-sede', [SedeController::class, 'edit'])->name('admin.sedes.edit')->middleware('rol:administrador');
// Actualizar una sede
Route::put('/admin/actualizar-sede/{sede}', [SedeController::class, 'update'])->name('admin.sedes.update')->middleware('rol:administrador');
// Eliminar una sede
Route::delete('/admin/eliminar-sede/{sede}', [SedeController::class, 'destroy'])->name('admin.sedes.destroy')->middleware('rol:administrador');


// Listar todas las tareas
Route::get('/admin/gestionar-tareas', [TareaController::class, 'index'])->name('admin.tareas.index')->middleware('rol:administrador');
//formulario para crear una nueva tarea
Route::get('/admin/tareas/crear-tarea', [TareaController::class, 'create'])->name('admin.tareas.create')->middleware('rol:administrador');
// Guardar nueva tarea
Route::post('/admin/guardar-tarea', [TareaController::class, 'store'])->name('admin.tareas.store')->middleware('rol:administrador');
// Mostrar detalles de una tarea
Route::get('/admin/detallar-tarea/{tarea}', [TareaController::class, 'show'])->name('admin.tareas.show')->middleware('rol:administrador',);
//formulario para editar una tarea
Route::get('/admin/tareas/{tarea}/editar-tarea', [TareaController::class, 'edit'])->name('admin.tareas.edit')->middleware('rol:administrador');
// Actualizar un tarea
Route::put('/admin/actualizar-tarea/{tarea}', [TareaController::class, 'update'])->name('admin.tareas.update')->middleware('rol:administrador');
// Eliminar una tarea
Route::delete('/admin/eliminar-tarea/{tarea}', [TareaController::class, 'destroy'])->name('admin.tareas.destroy')->middleware('rol:administrador');


//Rutas Tecnico//

// Visualizar tarea asignadas
Route::get('/tecnico/gestionar-tareas', [TareaController::class, 'indexTecnico'])->name('tecnico.tareas.index')->middleware('rol:tecnico');
Route::get('/tecnico/visualizar-tarea/{tarea}', [TareaController::class,'verTarea'])->name('tecnico.tareas.show') ->middleware('rol:tecnico');
// Formulario de resolución
Route::get('/tecnico/resolucion/{tarea}', [TareaController::class, 'formularioResolucion'])->name('tecnico.tareas.resolucion')->middleware('rol:tecnico');
// Procesar el formulario (subir resolución)
Route::post('/tecnico/guardar-resolucion/{tarea}', [TareaController::class, 'subirResolucion'])->name('tecnico.tareas.subirResolucion')->middleware('rol:tecnico');



//Rutas Encargado

//Visualizar tareas creadas
Route::get('/encargado/tareas/gestionar-tareas', [TareaController::class, 'indexEncargado'])->name('encargado.tareas.listadoTareas')->middleware('rol:encargado');
//Crear Tarea
Route::get('/encargado/tareas/crear-tarea', [TareaController::class, 'crearTareaEncargado'])->name('encargado.tareas.crearTarea')->middleware('rol:encargado');
// Guardar nueva tarea
Route::post('/encargado/tareas/guardar-tarea', [TareaController::class, 'storeEncargado'])->name('encargado.tareas.guardarTarea')->middleware('rol:encargado');
//formulario para editar una tarea
Route::get('/encargado/tareas/{tarea}/editar-tarea', [TareaController::class,'editEncargado'])->name('encargado.tareas.editarTarea') ->middleware('rol:encargado');
// Mostrar detalles de una tarea
Route::get('/encargado/ver-tarea/{tarea}', [TareaController::class,'showEncargado'])->name('encargado.tareas.verTarea') ->middleware('rol:encargado');
// Actualizar un tarea
Route::put('/encargado/actualizar-tarea/{tarea}', [TareaController::class, 'updateEncargado'])->name('encargado.tareas.updateTarea')->middleware('rol:encargado');
// Eliminar una tarea
Route::delete('/encargado/borrar-tarea/{tarea}', [TareaController::class, 'destroyEncargado'])->name('encargado.tareas.destroy')->middleware('rol:encargado');
//Listado de tareas concluidas
Route::get('/encargado/tareas/visualizar-tareas-concluidas', [TareaController::class, 'indexEncargadoConclusas'])->name('encargado.tareas.listadoTareasConclusas')->middleware('rol:encargado');


//ruta calendario
Route::get('/encargado/calendario', [EventoController::class, 'index'])->name('encargado.calendario.index')->middleware('rol:encargado');
Route::post('/encargado/calendario/agregar-evento', [EventoController::class, 'store'])->middleware('rol:encargado');
Route::post('/encargado/calendario/mostrar', [EventoController::class, 'show'])->middleware('rol:encargado');
Route::post('/encargado/calendario/editar-evento/{id}', [EventoController::class, 'edit'])->middleware('rol:encargado');
Route::post('/encargado/calendario/actualizar-evento/{evento}', [EventoController::class, 'update'])->middleware('rol:encargado');
Route::post('/encargado/calendario/eliminar-evento/{id}', [EventoController::class, 'destroy'])->middleware('rol:encargado');




//Auditor
//Rutas Sedes
//Listado de Sedes
Route::get('/auditor/sedes/listado-sedes', [SedeController::class, 'indexAuditor'])->name('auditor.sedes.listadoSedes')->middleware('rol:auditor');
//Visualizar Sede
Route::get('/auditor/detallar-sede/{sede}', [SedeController::class, 'showAuditor'])->name('auditor.sedes.verSede')->middleware('rol:auditor');
//Visualizar Tareas Finalizadas
Route::get('/auditor/tareas/visualizar-tareas', [TareaController::class, 'indexFinalizadasAuditor'])->name('auditor.tareas.finalizadas')->middleware('rol:auditor');
//Mostrar detalles de una tarea finalizada y formulario de validación
Route::get('/auditor/visualizar-tarea-resolucion/{tarea}', [TareaController::class,'visualizarResolucion'])->name('auditor.tareas.visualizar') ->middleware('rol:auditor');
// Procesar el formulario de validación/rechazo
Route::post('/auditor/procesar-resolucion/{tarea}', [TareaController::class, 'procesarResolucion'])->name('auditor.tareas.procesarResolucion')->middleware('rol:auditor');
//Listado de tareas concluidas global
Route::get('/auditor/tareas/visualizar-tareas-resueltas-global', [TareaController::class, 'indexConclusasResueltasGlobal'])->name('auditor.tareas.listadoTareasResueltasGlobal')->middleware('rol:auditor');
