<?php

use App\Http\Controllers\MedidaController;
use Illuminate\Support\Facades\Route;

Route::get('/medidas', [MedidaController::class, 'index'])
    ->name('medidas.index')
    ->middleware('permission:medidas.index');

Route::get('/medidas/create', [MedidaController::class, 'create'])
    ->name('medidas.create')
    ->middleware('permission:medidas.create');

Route::post('/medidas/store', [MedidaController::class, 'store'])
    ->name('medidas.store')
    ->middleware('permission:medidas.create');

Route::get('/medidas/{medida}/edit', [MedidaController::class, 'edit'])
    ->name('medidas.edit')
    ->middleware('permission:medidas.edit');

Route::patch('/medidas/{medida}', [MedidaController::class, 'update'])
    ->name('medidas.update')
    ->middleware('permission:medidas.edit');

Route::delete('medidas/{medida}', [MedidaController::class, 'destroy'])
    ->name('medidas.destroy')
    ->middleware('permission:medidas.destroy');
    