<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SoporteTecnicoController extends Controller{
    /**
     * @OA\Get(
     *     path="/api/soporte",
     *     tags={"Soporte"},
     *     summary="Vista de soporte técnico",
     *     description="Obtiene la vista de soporte técnico según el rol del usuario",
     *     @OA\Response(
     *         response=200,
     *         description="Vista cargada correctamente"
     *     ),
     *     @OA\Response(
     *         response=403,
     *         description="Acceso denegado"
     *     )
     * )
     */
    public function index(){
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
