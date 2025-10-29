<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    //Mostrar formulario de login
    public function showLoginForm()
    {
        if (Auth::check() !== false) return redirect()->route('inicio');
        return view('auth.login');
    }

    //Procesar inicio de sesión
    public function login(Request $request)
    {
        $request->validate([
            'correo'   => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        $credenciales = [
            'correo'   => $request->correo,
            'password' => $request->password,
        ];

        if (Auth::attempt($credenciales, $request->boolean('remember')) === true) {
            $request->session()->regenerate();
            return redirect()->intended(route('inicio'));
        }

        return back()->withErrors(['correo' => 'Credenciales inválidas'])->onlyInput('correo');
    }

    // ---------- NUEVO: registro ----------
    // /registro/{tipo?} -> muestra formulario
    public function showRegister(?string $tipo = null)
    {
        if (Auth::check()) return redirect()->route('inicio');
        // Pasa $tipo a la vista por si quieres variar campos/labels
        return view('auth.register', compact('tipo'));
    }

    // POST /registro -> crea usuario
    public function register(Request $request)
    {
        $request->validate([
            'nombre'   => ['required', 'string', 'max:150'],
            'correo'   => ['required', 'email', 'unique:usuarios,correo'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            // Si usas más campos, añádelos aquí (telefono, rol, etc.)
        ]);

        $usuario = Usuario::create([
            'nombre'   => $request->nombre,
            'correo'   => $request->correo,
            'password' => Hash::make($request->password),
            // 'rol' => $request->rol ?? 'Cliente', // ejemplo
        ]);

        Auth::login($usuario);
        $request->session()->regenerate();

        return redirect()->intended(route('inicio'))
            ->with('success', 'Registro exitoso. ¡Bienvenido!');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('inicio')->with('success', 'Sesión cerrada.');
    }
}
