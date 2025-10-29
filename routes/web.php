<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InicioController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\TipoProductoController;

/* Inicio */

Route::get('/', InicioController::class)->name('inicio');
Route::redirect('/inicio', '/')->name('inicio.inicio');

/* Auth */
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.submit'); // Cambiado a login.submit
});

/* Auth (privado: autenticados) */
Route::middleware('auth')->group(function () {
    // SOLO UNA RUTA DE LOGOUT
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Paneles por rol
    Route::view('/panel/cliente', 'panel.cliente')->name('cliente.panel');
    Route::view('/panel/gerente', 'panel.gerente')->name('gerente.panel');
    Route::view('/panel/admin',   'panel.admin')->name('admin.panel');
});

// ELIMINAR LAS RUTAS DE REGISTRO QUE NO EXISTEN O COMENTARLAS
// Route::get('/registro/{tipo?}', [AuthController::class, 'showRegister'])->name('registro');
// Route::post('/registro', [AuthController::class, 'register'])->name('registro.submit');

/* Productos (CRUD completo) */
Route::resource('productos', ProductoController::class);

/* Usuarios */
Route::resource('usuarios', UsuarioController::class);

/* Tipos de Producto */
Route::resource('tiposProducto', TipoProductoController::class);
Route::get('/tipos', fn() => redirect()->route('tiposProducto.index'))->name('tiposProducto.tipos');
Route::get('/categorias', fn() => redirect()->route('tiposProducto.index'))->name('tiposProducto.categorias');
