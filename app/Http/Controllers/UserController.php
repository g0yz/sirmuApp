<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // Mostrar todos los usuarios (excepto admin)
    public function index()
    {
        $users = User::where('rol', '!=', User::ROL_ADMIN)->get();
        return view('usuarios.index', compact('users'));
    }

    // Mostrar formulario de creación
    public function create()
    {
        return view('usuarios.create');
    }

    // Guardar nuevo usuario y persona
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
            'rol' => 'required|in:tecnico,encargado,auditor',
            'persona.nombre' => 'nullable|string|max:255',
            'persona.apellido' => 'nullable|string|max:255',
        ]);

        $user = User::create([
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'rol' => $request->rol,
        ]);

        if ($request->filled('persona.nombre') || $request->filled('persona.apellido')) {
            $user->persona()->create([
                'nombre' => $request->persona['nombre'] ?? null,
                'apellido' => $request->persona['apellido'] ?? null,
            ]);
        }

        return redirect()->route('usuarios.index')->with('success', 'Usuario creado correctamente.');
    }

    // Mostrar detalle de usuario
    public function show(User $user)
    {
        if ($user->rol === User::ROL_ADMIN) {
            abort(403);
        }
        return view('usuarios.show', compact('user'));
    }

    // Mostrar formulario de edición
    public function edit(User $user)
    {
        if ($user->rol === User::ROL_ADMIN) {
            abort(403);
        }
        return view('usuarios.edit', compact('user'));
    }

    // Actualizar usuario y persona
    public function update(Request $request, User $user)
    {
        if ($user->rol === User::ROL_ADMIN) {
            abort(403);
        }

        $request->validate([
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|min:6|confirmed',
            'rol' => 'required|in:tecnico,encargado,auditor',
            'persona.nombre' => 'nullable|string|max:255',
            'persona.apellido' => 'nullable|string|max:255',
        ]);

        $user->email = $request->email;
        $user->rol = $request->rol;
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }
        $user->save();

        if ($request->filled('persona.nombre') || $request->filled('persona.apellido')) {
            if ($user->persona) {
                $user->persona->update([
                    'nombre' => $request->persona['nombre'] ?? null,
                    'apellido' => $request->persona['apellido'] ?? null,
                ]);
            } else {
                $user->persona()->create([
                    'nombre' => $request->persona['nombre'] ?? null,
                    'apellido' => $request->persona['apellido'] ?? null,
                ]);
            }
        }

        return redirect()->route('usuarios.index')->with('success', 'Usuario actualizado correctamente.');
    }

    // Eliminar usuario
    public function destroy(User $user)
    {
        if ($user->rol === User::ROL_ADMIN) {
            abort(403);
        }

        $user->delete();
        return redirect()->route('usuarios.index')->with('success', 'Usuario eliminado correctamente.');
    }
}
