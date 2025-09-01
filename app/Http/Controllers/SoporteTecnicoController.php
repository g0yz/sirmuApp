<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SoporteTecnicoController extends Controller
{

public function index()
{
    $user = auth()->user();

    $layouts = [
        'administrador' => 'admin.dashboard',
        'tecnico'       => 'tecnico.dashboard',
        'encargado'     => 'encargado.dashboard',
        'auditor'       => 'auditor.dashboard',
    ];

    $layout = $layouts[$user->rol] ?? 'guest.dashboard';

    return view('soporteTecnico', compact('layout'));
}

}
