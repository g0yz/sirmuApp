<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Usuario;
use App\Models\Persona;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    /**
     * Mostrar el formulario de login
     */
    public function showLoginForm()
    {
        return view('login');
    }

    /**
     * Procesar el login
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');
        $remember = $request->boolean('remember');

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();
            
            $user = Auth::user();
            // Agregar el rol del usuario a la sesión
            $request->session()->put('rol', $user->rol);
            
            switch ($user->rol) {
                case Usuario::ROL_ADMIN:
                    return redirect()->route('admin.dashboard');
                case Usuario::ROL_TECNICO:
                    return redirect()->route('tecnico.dashboard');
                case Usuario::ROL_ENCARGADO:
                    return redirect()->route('encargado.dashboard');
                case Usuario::ROL_AUDITOR:
                    return redirect()->route('auditor.dashboard');
                default:
                    return redirect()->route('home');
    }        
           }

        throw ValidationException::withMessages([
            'email' => ['Las credenciales proporcionadas no coinciden con nuestros registros.'],
        ]);
    }

    /**
     * Mostrar el formulario de registro
     */
    public function showRegisterForm()
    {
        return view('register');
    }

    /**
     * Procesar el registro
     */
    public function register(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email|max:255|unique:usuarios,email',
            'rol' => 'required',
            'password' => 'required|string|min:8|confirmed',
            'nombre'=>'required',
            'apellido'=>'required',

        ]);
        $usuario = Usuario::create([
            'email' => $request->email,
            'password' => $request->password, //se encripta sola
            'rol' => $request->rol,
        ]);
        $usuario->persona()->create([
            'nombre' => $request->nombre,
            'apellido' => $request->apellido,

        ]);


        Auth::login($usuario);
        // Agregar el rol del usuario a la sesión
        $request->session()->put('rol', $usuario->rol);
        return redirect(route('home'))->with('success', '¡Cuenta creada exitosamente!');
    }

    /**
     * Cerrar sesión
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect(route('guest'))->with('success', 'Sesión cerrada correctamente.');
    }
}