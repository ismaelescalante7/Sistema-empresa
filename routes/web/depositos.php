<?php

use App\Http\Controllers\DepositoController;
use App\Http\Controllers\MarcaController;
use Illuminate\Support\Facades\Route;

Route::get('/depositos', [DepositoController::class, 'index'])
    ->name('depositos.index')
    ->middleware('permission:depositos.index');

Route::get('/depositos/create', [DepositoController::class, 'create'])
    ->name('depositos.create')
    ->middleware('permission:depositos.create');

Route::post('/depositos/store', [DepositoController::class, 'store'])
    ->name('depositos.store')
    ->middleware('permission:depositos.create');

Route::get('/depositos/{deposito}/edit', [DepositoController::class, 'edit'])
    ->name('depositos.edit')
    ->middleware('permission:depositos.edit');

Route::patch('/depositos/{deposito}', [DepositoController::class, 'update'])
    ->name('depositos.update')
    ->middleware('permission:depositos.edit');

Route::delete('depositos/{deposito}', [DepositoController::class, 'destroy'])
    ->name('depositos.destroy')
    ->middleware('permission:depositos.destroy');