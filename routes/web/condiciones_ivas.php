<?php

use App\Http\Controllers\CondicionIvaController;
use Illuminate\Support\Facades\Route;

Route::get('/condiciones-ivas', [CondicionIvaController::class, 'index'])
    ->name('condiciones.ivas.index')
    ->middleware('permission:condiciones.ivas.index');

Route::get('/condiciones-ivas/create', [CondicionIvaController::class, 'create'])
    ->name('marcas.create')
    ->middleware('permission:condiciones.ivas.create');

Route::post('/condiciones-ivas/store', [CondicionIvaController::class, 'store'])
    ->name('condiciones.ivas.store')
    ->middleware('permission:condiciones.ivas.create');

Route::get('/condiciones-ivas/{condicionIva}/edit', [CondicionIvaController::class, 'edit'])
    ->name('condiciones.ivas.edit')
    ->middleware('permission:condiciones.ivas.edit');

Route::patch('/condiciones-ivas/{condicionIva}', [CondicionIvaController::class, 'update'])
    ->name('condiciones.ivas.update')
    ->middleware('permission:condiciones.ivas.edit');

Route::delete('condiciones-ivas/{condicionIva}', [CondicionIvaController::class, 'destroy'])
    ->name('condiciones.ivas.destroy')
    ->middleware('permission:condiciones.ivas.destroy');