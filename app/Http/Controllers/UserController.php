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
        //$users = User::where('rol', '!=', User::ROL_ADMIN)->get();
        $users= User::all();
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
            'nombre' => 'nullable|string|max:255',
            'apellido' => 'nullable|string|max:255',
        ]);

        $user = User::create([
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'rol' => $request->rol,
        ]);

        if ($request->filled('nombre') || $request->filled('apellido')) {
            $user->persona()->create([
                'nombre' => $request->nombre,
                'apellido' => $request->apellido,
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
            'nombre' => 'nullable|string|max:255',
            'apellido' => 'nullable|string|max:255',
        ]);

        $user->email = $request->email;
        $user->rol = $request->rol;
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }
        $user->save();

        if ($request->filled('nombre') || $request->filled('apellido')) {
            if ($user->persona) {
                $user->persona->update([
                    'nombre' => $request->nombre,
                    'apellido' => $request->apellido,
                ]);
            } else {
                $user->persona()->create([
                    'nombre' => $request->nombre,
                    'apellido' => $request->apellido,
                ]);
            }
        }

        return redirect()->route('usuarios.index')->with('success', 'Usuario actualizado correctamente.');
    }

    // Eliminar usuario
    public function destroy(User $usuario)
    {
        if ($usuario->rol === User::ROL_ADMIN) {
            abort(403);
        }

        $usuario->delete();
        return redirect()->route('usuarios.index')->with('success', 'Usuario eliminado correctamente.');
    }
}
