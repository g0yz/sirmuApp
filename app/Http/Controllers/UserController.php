<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller{
    // Mostrar todos los usuarios (excepto admin)
    /**
     * @OA\Get(
     *     path="/api/usuarios",
     *     tags={"Usuarios"},
     *     summary="Listar usuarios",
     *     description="Obtiene todos los usuarios del sistema",
     *     @OA\Response(
     *         response=200,
     *         description="Lista de usuarios obtenida correctamente"
     *     )
     * )
     */
    public function index()
    {
        //$users = User::where('rol', '!=', User::ROL_ADMIN)->get();
        $users= User::all();
        return view('admin.usuarios.index', compact('users'));
    }
     /**
     * @OA\Get(
     *     path="/api/usuarios/create",
     *     tags={"Usuarios"},
     *     summary="Mostrar formulario de creación de usuario",
     *     @OA\Response(response=200, description="Formulario de creación")
     * )
     */
    public function create()
    {
        return view('admin.usuarios.create');
    }
    /**
     * @OA\Post(
     *     path="/api/usuarios",
     *     tags={"Usuarios"},
     *     summary="Crear usuario",
     *     description="Crea un nuevo usuario y su persona asociada",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"email","password","rol"},
     *             @OA\Property(property="email", type="string", format="email"),
     *             @OA\Property(property="password", type="string", format="password"),
     *             @OA\Property(property="password_confirmation", type="string", format="password"),
     *             @OA\Property(property="rol", type="string", enum={"tecnico","encargado","auditor"}),
     *             @OA\Property(property="nombre", type="string"),
     *             @OA\Property(property="apellido", type="string")
     *         )
     *     ),
     *     @OA\Response(response=201, description="Usuario creado"),
     *     @OA\Response(response=422, description="Error de validación")
     * )
     */
    public function store(Request $request)
    {
        // Chequear si se intenta crear un administrador
        if($request->rol === 'administrador') {
            $existeAdmin = User::where('rol', 'administrador')->first();
            if($existeAdmin){
                return redirect()->back()->with('error', 'Ya existe un administrador en el sistema.');
            }
        }   
        $request->validate([
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
            //usuarios de tipo admin no se pueden crear
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

        return redirect()->route('admin.usuarios.index')->with('success', 'Usuario creado correctamente.');
    }
    /**
     * @OA\Get(
     *     path="/api/usuarios/{id}",
     *     tags={"Usuarios"},
     *     summary="Mostrar usuario",
     *     description="Muestra un usuario por su ID",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(response=200, description="Detalle del usuario"),
     *     @OA\Response(response=403, description="Acceso denegado"),
     *     @OA\Response(response=404, description="Usuario no encontrado")
     * )
     */
    public function show(User $user)
    {
        return view('admin.usuarios.show', compact('user'));
    }
    /**
     * @OA\Get(
     *     path="/api/usuarios/{id}/edit",
     *     tags={"Usuarios"},
     *     summary="Mostrar formulario de edición de usuario",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(response=200, description="Formulario de edición")
     * )
     */
    public function edit(User $user)
    {
        return view('admin.usuarios.edit', compact('user'));
    }

    /**
     * @OA\Put(
     *     path="/api/usuarios/{id}",
     *     tags={"Usuarios"},
     *     summary="Actualizar usuario",
     *     description="Actualiza los datos de un usuario existente",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="email", type="string", format="email"),
     *             @OA\Property(property="password", type="string", format="password"),
     *             @OA\Property(property="password_confirmation", type="string", format="password"),
     *             @OA\Property(property="rol", type="string", enum={"tecnico","encargado","auditor"}),
     *             @OA\Property(property="nombre", type="string"),
     *             @OA\Property(property="apellido", type="string")
     *         )
     *     ),
     *     @OA\Response(response=200, description="Usuario actualizado"),
     *     @OA\Response(response=403, description="Acceso denegado"),
     *     @OA\Response(response=422, description="Error de validación")
     * )
     */
    public function update(Request $request, User $user)
    {

        $request->validate([
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|min:6|confirmed',
            //Usuarios de Tipo Admin no pueden ser editados
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

        return redirect()->route('admin.usuarios.index')->with('success', 'Usuario actualizado correctamente.');
    }

        /**
     * @OA\Delete(
     *     path="/api/usuarios/{id}",
     *     tags={"Usuarios"},
     *     summary="Eliminar usuario",
     *     description="Elimina un usuario por su ID",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(response=200, description="Usuario eliminado"),
     *     @OA\Response(response=403, description="Acceso denegado"),
     *     @OA\Response(response=404, description="Usuario no encontrado")
     * )
     */
    public function destroy(User $user)
    {

        $user->delete();
        return redirect()->route('admin.usuarios.index')->with('success', 'Usuario eliminado correctamente.');
    }
}
