<?php

use App\Http\Controllers\ProductoController;
use Illuminate\Support\Facades\Route;

Route::get('/productos', [ProductoController::class, 'index'])
    ->name('productos.index')
    ->middleware('permission:administracion.consulta_productos');

Route::get('/productos/create', [ProductoController::class, 'create'])
    ->name('productos.create')
    ->middleware('permission:administracion.crear_producto');

Route::post('/productos/store', [ProductoController::class, 'store'])
    ->name('productos.store');