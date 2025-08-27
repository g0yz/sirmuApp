<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\DashboardController;


class DashboardController extends Controller
{
    public function admin()
    {
        if (Auth::user()->rol !== 'administrador') {
            abort(403, 'Acceso denegado');
        }

        return view('admin.dashboard');
    }

    public function tecnico()
    {
        if (Auth::user()->rol !== 'tecnico') {
            abort(403, 'Acceso denegado');
        }

        return view('tecnico.dashboard');
    }

        public function encargado()
    {
        if (Auth::user()->rol !== 'encargado') {
            abort(403, 'Acceso denegado');
        }

        return view('encargado.dashboard');
    }

    public function auditor()
    {
        if (Auth::user()->rol !== 'auditor') {
            abort(403, 'Acceso denegado');
        }

        return view('auditor.dashboard');
    }



    public function soporteTecnico(){


        return view('soporteTecnico');
    }



}
