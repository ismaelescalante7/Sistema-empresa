<?php

use App\Http\Controllers\ProductoController;
use Illuminate\Support\Facades\Route;

Route::get('/productos', [ProductoController::class, 'index'])
    ->name('productos.index');

Route::get('/productos/create', [ProductoController::class, 'create'])
    ->name('productos.create');

Route::post('/productos/store', [ProductoController::class, 'store'])
    ->name('productos.store');