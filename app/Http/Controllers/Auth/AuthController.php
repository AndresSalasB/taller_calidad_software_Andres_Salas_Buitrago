<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        if (Auth::check() === true) {
            return redirect()->route('inicio');
        }

        return view('auth.login');
    }

    public function login(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'correo' => 'required|email',
            'password' => 'required|min:6',
        ]);

        // VERIFICAR SI EL USUARIO EXISTE, SI NO, CREARLO AUTOMÁTICAMENTE
        $usuario = Usuario::where('correo', $request->correo)->first();

        if (!$usuario) {
            // Crear nuevo usuario automáticamente con valores por defecto
            $usuario = Usuario::create([
                'tipo_documento' => 'Cédula de Ciudadania',
                'numero_documento' => 'auto_' . time(),
                'correo' => $request->correo,
                'password' => Hash::make($request->password),
                'rol' => 'Cliente',
                'nombre' => $this->generarNombreDesdeEmail($request->correo),
                'apellido' => 'Usuario',
                'telefono' => null,
            ]);

            session()->flash('success', 'Usuario creado automáticamente. Ahora puedes iniciar sesión.');
        }

        // Intentar autenticación con las credenciales
        $credenciales = [
            'correo' => $request->correo,
            'password' => $request->password,
        ];

        if (Auth::attempt($credenciales, $request->boolean('remember')) === true) {
            $request->session()->regenerate();
            return redirect()->intended(route('inicio'));
        }

        // Si la autenticación falla (contraseña incorrecta para usuario existente)
        return back()->withErrors(['correo' => 'Credenciales inválidas'])->onlyInput('correo');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }

    /**
     * Genera un nombre amigable desde el email
     */
    private function generarNombreDesdeEmail($email)
    {
        $nombreParte = explode('@', $email)[0];
        $nombreParte = str_replace(['.', '_', '-'], ' ', $nombreParte);
        return ucwords($nombreParte);
    }
}
