<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');// Mostrar formulario login
Route::post('/login', [AuthController::class, 'login'])->middleware('guest'); // Procesar login

Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register'); // Mostrar formulario registro
Route::post('/register', [AuthController::class, 'register'])->middleware('guest');  // Procesar registro

Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');  // Cerrar sesión

//ROLES RUTAS PRINCIPALES
    Route::get('/admin', function(){ return view('admin.dashboard'); })->name('admin.dashboard');
    Route::get('/tecnico', function(){ return view('tecnico.dashboard'); })->name('tecnico.dashboard');
    Route::get('/encargado', function(){ return view('encargado.dashboard'); })->name('encargado.dashboard');
    Route::get('/auditor', function(){ return view('auditor.dashboard'); })->name('auditor.dashboard');

