<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ConfiguracionController extends Controller{
    /**
    * @OA\Get(
    *   path="/configuracion",
    *   summary="Ver configuración según rol del usuario",
    *   tags={"Configuración"},
    *   security={{"sanctum":{}}},
    *   @OA\Response(
    *     response=200,
    *     description="Vista de configuración renderizada según el rol del usuario",
    *     @OA\JsonContent(
    *       @OA\Property(property="layout", type="string", example="admin.dashboard")
    *     )
    *   ),
    *   @OA\Response(
    *     response=401,
    *     description="No autenticado"
    *   )
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

        return view('configuracion', compact('layout'));
    }

}
