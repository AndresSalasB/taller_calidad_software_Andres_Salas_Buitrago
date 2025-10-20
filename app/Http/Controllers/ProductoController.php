<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;


class ProductoController extends Controller
{
    /**
     * Lista de Productos
     */
    public function index()
    {
        $productos = Producto::all();
        return view('productos.index', compact('productos'));
    }

    /**
     * Formulario donde están los campos a registrar 
     */
    public function create()
    {
        return view('productos.create');
    }

    /**
     * Metodo para almacenar el producto
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'marca' => 'required|string|max:60',
            'modelo' => 'required|string|max:260',
            'descripcion' => 'nullable|string|max:400',
            'precio' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'imagen' => 'nullable|url|max:300',
            'usuario_id' => 'nullable|integer|exists:usuarios,id',
            'tipo_producto_id' => 'nullable|integer|exists:tipos_productos,id'
        ]);

        Producto::create($validated);

        return redirect()->route('productos.index')
            ->with('success', 'Producto creado exitosamente');
    }

    /**
     * Mostrar los detalles de un producto 
     */
    public function show(Producto $producto)
    {
        return view('productos.show', compact('producto'));
    }

    /**
     * Click en el boton edit para editar un producto
     */
    public function edit(Producto $producto)
    {
        return view('productos.edit', compact('producto'));
    }

    /**
     * Boton de actualizar en el formulario 
     */
    public function update(Request $request, Producto $producto)
    {
        $validated = $request->validate([
            'marca' => 'required|string|max:60',
            'modelo' => 'required|string|max:260',
            'descripcion' => 'nullable|string|max:400',
            'precio' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'imagen' => 'nullable|url|max:300',
            'usuario_id' => 'nullable|integer|exists:usuarios,id',
            'tipo_producto_id' => 'nullable|integer|exists:tipos_productos,id',

        ]);

        $producto->update($validated);

        return redirect()->route('productos.index')
            ->with('success', 'Producto actualizado exitosamente');
    }

    /**
     * Eliminar un producto
     */
    public function destroy(Producto $producto)
    {
        $producto->delete();

        return redirect()->route('productos.index')
            ->with('success', 'Producto eliminado exitosamente');
    }
}
