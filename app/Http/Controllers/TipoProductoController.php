<?php

namespace App\Http\Controllers;

use App\Models\TipoProducto;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;


class TipoProductoController extends Controller
{
    /**
     * Lista de Tipos de Productos
     */
    public function index()
    {
        $tipos = TipoProducto::all();
        return view('tiposProducto.tipos', compact('tipos'));
    }

    /**
     * Formulario donde están los campos a registrar 
     */
    public function create()
    {
        return view('tiposProducto.create');
    }

    /**
     * Metodo para almacenar el producto
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:80',
            'descripcion' => 'nullable|string|max:300',
        ]);

        TipoProducto::create($validated);

        return redirect()->route('tipoProducto.tipos')
            ->with('success', 'Tipo de producto creado exitosamente');
    }


    /**
     * Mostrar los detalles de un tipo de producto
     */
    public function show(TipoProducto $tipo)
    {
        return view('tiposProducto.show', compact('tipo'));
    }

    /**
     * Click en el boton edit para editar un tipo de producto
     */
    public function edit(TipoProducto $tipo)
    {
        return view('tiposProducto.edit', compact('tipo'));
    }

    /**
     * Boton de actualizar en el formulario 
     */
    public function update(Request $request, TipoProducto $tipo)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:80',
            'descripcion' => 'nullable|string|max:300',
        ]);

        $tipo->update($validated);

        return redirect()->route('tiposProducto.index')
            ->with('success', 'Tipo de producto actualizado exitosamente');
    }

    /**
     * Eliminar un tipo de producto
     */
    public function destroy(TipoProducto $tipo)
    {
        $tipo->delete();

        return redirect()->route('tiposProducto.index')
            ->with('success', 'Tipo de producto eliminado exitosamente');
    }
}
