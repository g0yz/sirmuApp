<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use App\Models\User;
use App\Models\Persona;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller{
    /**
    * @OA\Post(
    *   path="/login",
    *   summary="Iniciar sesión",
    *   tags={"Auth"},
    *   @OA\RequestBody(
    *     required=true,
    *     @OA\JsonContent(
    *       required={"email","password"},
    *       @OA\Property(property="email", type="string", example="user@mail.com"),
    *       @OA\Property(property="password", type="string", example="password123"),
    *       @OA\Property(property="remember", type="boolean", example=true)
    *     )
    *   ),
    *   @OA\Response(
    *     response=200,
    *     description="Login exitoso, redirige según rol"
    *   ),
    *   @OA\Response(
    *     response=422,
    *     description="Credenciales incorrectas"
    *   )
    * )
    */
    public function login(Request $request){
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

            $credentials = $request->only('email', 'password');

            $remember = $request->boolean('remember');

        if (Auth::attempt($credentials, $remember)) {
                $request->session()->regenerate();
                $user = Auth::user();
                $request->session()->put('rol', $user->rol);

            switch ($user->rol) {
                case 'administrador':
                    return redirect()->route('admin.dashboard');
                case 'tecnico':
                    return redirect()->route('tecnico.dashboard');
                case 'encargado':
                    return redirect()->route('encargado.dashboard');
                case 'auditor':
                    return redirect()->route('auditor.dashboard');
                default:
                    return redirect()->route('login'); // fallback seguro
            }  
        }

        throw ValidationException::withMessages([
            'email' => ['Error al Iniciar Sesion. Volver a ingresar los datos'],
        ]);
    }
    /**
    * @OA\Post(
    *   path="/register",
    *   summary="Registrar nuevo usuario",
    *   tags={"Auth"},
    *   @OA\RequestBody(
    *     required=true,
    *     @OA\JsonContent(
    *       required={"email","password","password_confirmation","rol","nombre","apellido"},
    *       @OA\Property(property="email", type="string", example="nuevo@mail.com"),
    *       @OA\Property(property="password", type="string", example="password123"),
    *       @OA\Property(property="password_confirmation", type="string", example="password123"),
    *       @OA\Property(property="rol", type="string", example="administrador"),
    *       @OA\Property(property="nombre", type="string", example="Juan"),
    *       @OA\Property(property="apellido", type="string", example="Pérez")
    *     )
    *   ),
    *   @OA\Response(
    *     response=200,
    *     description="Registro exitoso y redirección"
    *   ),
    *   @OA\Response(
    *     response=422,
    *     description="Datos inválidos"
    *   )
    * )
    */
    public function register(Request $request){
        $request->validate([
            'email' => 'required|string|email|max:255|unique:users,email',
            'rol' => ['required', Rule::in([
                User::ROL_ADMIN,
                User::ROL_TECNICO,
                User::ROL_ENCARGADO,
                User::ROL_AUDITOR,
        ])],
            'password' => 'required|string|min:8|confirmed',
            'nombre' => 'required',
            'apellido' => 'required',
        ]);

        if ($request->rol === User::ROL_ADMIN && User::where('rol', User::ROL_ADMIN)->exists()) {
            return back()
                ->withErrors(['rol' => 'Ya existe un administrador en el sistema.'])
                ->withInput();
        }

        $user = User::create([
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'rol' => $request->rol,
        ]);

        $user->persona()->create([
            'nombre' => $request->nombre,
            'apellido' => $request->apellido,
        ]);

        Auth::login($user);
        $request->session()->put('rol', $user->rol);

        switch ($user->rol) {
            case 'administrador':
                return redirect()->route('admin.dashboard');
            case 'tecnico':
                return redirect()->route('tecnico.dashboard');
            case 'encargado':
                return redirect()->route('encargado.dashboard');
            case 'auditor':
                return redirect()->route('auditor.dashboard');
            default:
                return redirect()->route('login'); // fallback seguro
        }
    }
    /**
    * @OA\Post(
    *   path="/logout",
    *   summary="Cerrar sesión",
    *   tags={"Auth"},
    *   @OA\Response(
    *     response=200,
    *     description="Sesión cerrada correctamente"
    *   )
    * )
    */
    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'Sesión cerrada correctamente.');
    }

    public function showLoginForm(){
        // Si ya está logueado, redirigir a su dashboard
        if (auth()->check()) {
            return $this->redirectToDashboard();
        }
        return view('login');
    }

    public function showRegisterForm(){
        // Si ya está logueado, redirigir a su dashboard
        if (auth()->check()) {
            return $this->redirectToDashboard();
        }
        return view('register');
    }

    protected function redirectToDashboard(){
        $user = auth()->user();

        switch ($user->rol) {
            case 'administrador':
                return redirect()->route('admin.dashboard');
            case 'tecnico':
                return redirect()->route('tecnico.dashboard');
            case 'encargado':
                return redirect()->route('encargado.dashboard');
            case 'auditor':
                return redirect()->route('auditor.dashboard');
            default:
                return redirect()->route('login'); // fallback seguro
        }
    }


}


