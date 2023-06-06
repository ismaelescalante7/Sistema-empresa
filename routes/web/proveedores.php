<?php

use App\Http\Controllers\ProveedorController;
use Illuminate\Support\Facades\Route;

Route::get('/proveedores', [ProveedorController::class, 'index'])
    ->name('proveedores.index')
    ->middleware('permission:proveedores.index');

Route::get('/proveedores/create', [ProveedorController::class, 'create'])
    ->name('proveedores.create')
    ->middleware('permission:proveedores.create');

Route::post('/proveedores/store', [ProveedorController::class, 'store'])
    ->name('proveedores.store')
    ->middleware('permission:proveedores.create');

Route::get('/proveedores/{proveedor}/edit', [ProveedorController::class, 'edit'])
    ->name('proveedores.edit')
    ->middleware('permission:proveedores.edit');

Route::patch('/proveedores/{proveedor}', [ProveedorController::class, 'update'])
    ->name('proveedores.update')
    ->middleware('permission:proveedores.edit');

Route::delete('proveedores/{proveedor}', [ProveedorController::class, 'destroy'])
    ->name('proveedores.destroy')
    ->middleware('permission:proveedores.destroy');
    