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

Route::get('/productos/show/{producto}', [ProductoController::class, 'show'])
    ->name('productos.show')
    ->middleware('permission:productos.show');

Route::get('/productos/{producto}/edit', [ProductoController::class, 'edit'])
    ->name('productos.edit')
    ->middleware('permission:productos.edit');

Route::patch('/productos/{producto}', [ProductoController::class, 'update'])
    ->name('productos.update')
    ->middleware('permission:productos.edit');

Route::delete('productos/{producto}', [ProductoController::class, 'destroy'])
    ->name('productos.destroy')
    ->middleware('permission:productos.destroy');