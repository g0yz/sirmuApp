<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Persona;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // Mostrar listado de usuarios
    public function index()
    {
        $usuarios = User::with('persona')->get();
        return view('admin.usuarios', compact('usuarios'));
    }

    // Mostrar formulario para crear un nuevo usuario
    public function create()
    {
        return view('admin.usuarios_create'); // crea esta vista si querés
    }

    // Guardar nuevo usuario
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:users,email',
            'rol' => 'required|in:administrador,tecnico,encargado,auditor',
            'password' => 'required|string|min:8|confirmed',
            'nombre' => 'required|string',
            'apellido' => 'required|string',
        ]);

        $user = User::create([
            'email' => $request->email,
            'rol' => $request->rol,
            'password' => Hash::make($request->password),
        ]);

        $user->persona()->create([
            'nombre' => $request->nombre,
            'apellido' => $request->apellido,
        ]);

        return redirect()->route('usuarios.index')->with('success', 'Usuario creado correctamente');
    }

    // Mostrar formulario para editar un usuario
    public function edit(User $user)
    {
        return view('admin.usuarios_edit', compact('user'));
    }

    // Actualizar usuario
    public function update(Request $request, User $user)
    {
        $request->validate([
            'email' => 'required|email|unique:users,email,' . $user->id,
            'rol' => 'required|in:administrador,tecnico,encargado,auditor',
            'nombre' => 'required|string',
            'apellido' => 'required|string',
        ]);

        $user->update([
            'email' => $request->email,
            'rol' => $request->rol,
        ]);

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
            $user->save();
        }

        $user->persona()->update([
            'nombre' => $request->nombre,
            'apellido' => $request->apellido,
        ]);

        return redirect()->route('usuarios.index')->with('success', 'Usuario actualizado correctamente');
    }

    // Eliminar usuario
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('usuarios.index')->with('success', 'Usuario eliminado correctamente');
    }
}
