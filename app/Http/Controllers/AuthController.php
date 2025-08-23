<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Persona;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
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

    public function register(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email|max:255|unique:users,email',
            'rol' => 'required',
            'password' => 'required|string|min:8|confirmed',
            'nombre' => 'required',
            'apellido' => 'required',
        ]);

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

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'Sesión cerrada correctamente.');
    }

    public function showLoginForm()
    {
        // Si ya está logueado, redirigir a su dashboard
        if (auth()->check()) {
            return $this->redirectToDashboard();
        }
        return view('login');
    }

    public function showRegisterForm()
    {
        // Si ya está logueado, redirigir a su dashboard
        if (auth()->check()) {
            return $this->redirectToDashboard();
        }
        return view('register');
    }

    protected function redirectToDashboard()
    {
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
