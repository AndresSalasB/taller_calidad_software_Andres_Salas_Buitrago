<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
{
    public function index()
    {
        $usuarios = Usuario::latest()->paginate(10);
        return view('usuarios.index', compact('usuarios'));
    }

    public function create()
    {
        return view('usuarios.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'tipo_documento'   => ['required', Rule::in([
                'Cédula de Ciudadania',
                'Cédula de Extranjería',
                'Tarjeta de Identidad',
                'Pasaporte',
                'NIT'
            ])],
            'numero_documento' => ['required', 'string', 'max:30', 'unique:usuarios,numero_documento'],
            'correo'           => ['required', 'email', 'max:160', 'unique:usuarios,correo'],
            'password'         => ['required', 'string', 'min:8', 'confirmed'],
            'rol'              => ['required', Rule::in(['Administrador', 'Cliente', 'Gerente'])],
            'nombre'           => ['required', 'string', 'max:50'],
            'apellido'         => ['required', 'string', 'max:50'],
            'telefono'         => ['nullable', 'string', 'max:20'],
        ]);

        $usuario = Usuario::create([
            'tipo_documento'   => $request->tipo_documento,
            'numero_documento' => $request->numero_documento,
            'correo'           => $request->correo,
            'password'         => Hash::make($request->password),
            'rol'              => $request->rol,
            'nombre'           => $request->nombre,
            'apellido'         => $request->apellido,
            'telefono'         => $request->telefono,
        ]);

        return redirect()->route('usuarios.show', $usuario->id)
            ->with('success', 'Usuario creado correctamente.');
    }

    /** NUEVOS **/

    public function show(Usuario $usuario)
    {
        return view('usuarios.show', compact('usuario'));
    }

    public function edit(Usuario $usuario)
    {
        return view('usuarios.edit', compact('usuario'));
    }

    public function update(Request $request, Usuario $usuario)
    {
        $request->validate([
            'tipo_documento'   => ['required', Rule::in([
                'Cédula de Ciudadania',
                'Cédula de Extranjería',
                'Tarjeta de Identidad',
                'Pasaporte',
                'NIT'
            ])],
            'numero_documento' => [
                'required',
                'string',
                'max:30',
                Rule::unique('usuarios', 'numero_documento')->ignore($usuario->id)
            ],
            'correo'           => [
                'required',
                'email',
                'max:160',
                Rule::unique('usuarios', 'correo')->ignore($usuario->id)
            ],
            'password'         => ['nullable', 'string', 'min:8', 'confirmed'], // opcional en edición
            'rol'              => ['required', Rule::in(['Administrador', 'Cliente', 'Gerente'])],
            'nombre'           => ['required', 'string', 'max:50'],
            'apellido'         => ['required', 'string', 'max:50'],
            'telefono'         => ['nullable', 'string', 'max:20'],
        ]);

        $data = $request->only([
            'tipo_documento',
            'numero_documento',
            'correo',
            'rol',
            'nombre',
            'apellido',
            'telefono'
        ]);

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $usuario->update($data);

        return redirect()->route('usuarios.show', $usuario->id)
            ->with('success', 'Usuario actualizado correctamente.');
    }

    public function destroy(Usuario $usuario)
    {
        $usuario->delete();

        return redirect()->route('usuarios.index')
            ->with('success', 'Usuario eliminado correctamente.');
    }
}
