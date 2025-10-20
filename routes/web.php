<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InicioController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\TipoProductoController;

/*
|--------------------------------------------------------------------------
| Inicio
|--------------------------------------------------------------------------
| Si tu InicioController es invocable (__invoke), dejamos una sola ruta raíz.
| /inicio redirige a la raíz para evitar duplicados.
*/

Route::get('/', InicioController::class)->name('inicio');
Route::redirect('/inicio', '/')->name('inicio.inicio'); // alias opcional


/*
|--------------------------------------------------------------------------
| Productos
|--------------------------------------------------------------------------
| Recurso completo. Si quieres restringir creación/edición/eliminación,
| puedes añadir middleware en el constructor del ProductoController.
*/
Route::resource('productos', ProductoController::class);

/*
|--------------------------------------------------------------------------
| Usuarios
|--------------------------------------------------------------------------
| Recurso completo. Normalmente lo maneja personal con permisos (Admin).
| Si ya definiste una Policy o Gate "manage-users", lo aplicamos aquí.
| Si aún no, puedes comentar la línea del middleware y usarlo abierto.
*/
Route::middleware(['auth', 'can:manage-users'])->group(function () {
    Route::resource('usuarios', UsuarioController::class);
});
// --- Si aún no tienes gates/policies y quieres dejarlo abierto (no recomendado):
// Route::resource('usuarios', UsuarioController::class);

/*
|--------------------------------------------------------------------------
| Tipos de Producto
|--------------------------------------------------------------------------
| Recurso completo + atajos de navegación sin duplicar nombres.
| /tipos y /categorias redirigen al index del recurso para mantener una sola verdad.
*/
Route::resource('tiposProducto', TipoProductoController::class);
// Atajos amigables que apuntan al index del recurso:
Route::get('/tipos', fn() => redirect()->route('tiposProducto.index'))->name('tiposProducto.tipos');
Route::get('/categorias', fn() => redirect()->route('tiposProducto.index'))->name('tiposProducto.categorias');
