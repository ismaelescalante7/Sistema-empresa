<?php

use App\Http\Controllers\MarcaController;
use Illuminate\Support\Facades\Route;

Route::get('/marcas', [MarcaController::class, 'index'])
    ->name('marcas.index')
    ->middleware('permission:marcas.index');

Route::get('/marcas/create', [MarcaController::class, 'create'])
    ->name('marcas.create')
    ->middleware('permission:marcas.create');

Route::post('/marcas/store', [MarcaController::class, 'store'])
    ->name('marcas.store')
    ->middleware('permission:marcas.create');

Route::get('/marcas/{marca}/edit', [MarcaController::class, 'edit'])
    ->name('marcas.edit')
    ->middleware('permission:marcas.edit');

Route::patch('/marcas/{marca}', [MarcaController::class, 'update'])
    ->name('marcas.update')
    ->middleware('permission:marcas.edit');

Route::delete('marcas/{marca}', [MarcaController::class, 'destroy'])
    ->name('marcas.destroy')
    ->middleware('permission:marcas.destroy');