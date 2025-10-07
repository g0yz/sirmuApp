<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Mail;

use App\Mail\SoporteTecnicoMail;

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

    /**
     * Procesa el formulario de soporte técnico
     */
    public function enviar(Request $request)
    {
        $request->validate([
            'asunto' => 'required|string|max:255',
            'descripcion' => 'required|string',
        ]);

        //
        $emailUsuario = Auth()->user()->email;
        $nombreUsuario = Auth()->user()->persona->nombre;
        // Enviar correo al soporte
        Mail::mailer('soporte')->send(
            new SoporteTecnicoMail(
                $nombreUsuario,
                $emailUsuario,
                $request->asunto,
                $request->descripcion
            )
        );


        // Acá podrías enviar un correo o guardar el ticket en la base de datos
        // Por ahora simplemente devolvemos un mensaje de confirmación
        return back()->with('success', 'Tu consulta fue enviada correctamente. El equipo de soporte se pondrá en contacto a la brevedad.');
    }
}
