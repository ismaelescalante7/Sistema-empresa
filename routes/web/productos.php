<?php

use App\Http\Controllers\ProductoController;
use Illuminate\Support\Facades\Route;

Route::get('/productos', [ProductoController::class, 'index'])
    ->name('productos.index')
    ->middleware('permission:productos.index');

Route::get('/productos/create', [ProductoController::class, 'create'])
    ->name('productos.create')
    ->middleware('permission:productos.create');

Route::post('/productos/store', [ProductoController::class, 'store'])
    ->name('productos.store')
    ->middleware('permission:productos.create');