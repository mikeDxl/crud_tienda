<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\ClienteProductoController;

// Ruta principal
Route::get('/', function () {
    return view('dashboard');
})->name('dashboard');

// Rutas para clientes
Route::resource('clientes', ClienteController::class);

// Rutas para productos
Route::resource('productos', ProductoController::class);

// Rutas para compras (cliente-productos)
Route::resource('compras', ClienteProductoController::class);

// Ruta API para obtener precio de producto (para el formulario de compras)
Route::get('/api/productos/{producto}/precio', function ($id) {
    $producto = \App\Models\Producto::find($id);
    return response()->json(['precio' => $producto ? $producto->precio : 0]);
})->name('api.producto.precio');
