<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\Persona;
use App\Models\User;

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

    public function updatePerfil(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'nombre'   => ['required','string','max:120'],
            'apellido' => ['required','string','max:120'],
            'email'    => ['required','email', Rule::unique('users','email')->ignore($user->id)],
        ]);

        // Actualizar persona (crear si no existe)
        $persona = $user->persona()->firstOrNew(['user_id' => $user->id]);
        $persona->nombre   = $request->nombre;
        $persona->apellido = $request->apellido;
        $persona->save();

        // Actualizar email
        $user->update([
            'email' => $request->email,
        ]);

        return back()->with('success_perfil', 'Perfil actualizado correctamente.');
    }

    public function updatePassword(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'current_password'      => ['required'],
            'password'              => ['required','min:8','confirmed'],
        ]);

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'La contraseña actual no es correcta.'])->withInput();
        }

        $user->update([
            'password' => Hash::make($request->password),
        ]);

        return back()->with('success_password', 'Contraseña actualizada correctamente.');
    }

}
