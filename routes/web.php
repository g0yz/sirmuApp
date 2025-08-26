<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');// Mostrar formulario login
Route::post('/login', [AuthController::class, 'login'])->middleware('guest'); // Procesar login

Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register'); // Mostrar formulario registro
Route::post('/register', [AuthController::class, 'register'])->middleware('guest');  // Procesar registro

Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');  // Cerrar sesión

//ROLES RUTAS PRINCIPALES
    Route::get('/admin', [DashboardController::class, 'admin'])->name('admin.dashboard');
    Route::get('/tecnico', [DashboardController::class, 'tecnico'])->name('tecnico.dashboard');
    Route::get('/encargado', [DashboardController::class, 'encargado'])->name('encargado.dashboard');
    Route::get('/auditor', [DashboardController::class, 'auditor'])->name('auditor.dashboard');



Route::get('/soporte-tecnico', [DashboardController::class, 'soporteTecnico'])->name('soporteTecnico')->middleware('auth');