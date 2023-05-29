<?php

use App\Http\Controllers\ClienteController;
use Illuminate\Support\Facades\Route;

Route::get('/clientes', [ClienteController::class, 'index'])
    ->name('clientes.index')
    ->middleware('permission:clientes.index');

Route::get('/clientes/create', [ClienteController::class, 'create'])
    ->name('clientes.create')
    ->middleware('permission:clientes.create');

Route::post('/clientes/store', [ClienteController::class, 'store'])
    ->name('clientes.store')
    ->middleware('permission:clientes.create');

Route::get('/clientes/show/{cliente}', [ClienteController::class, 'show'])
    ->name('clientes.show')
    ->middleware('permission:clientes.show');

Route::delete('clientes/{cliente}', [ClienteController::class, 'destroy'])
    ->name('clientes.destroy')
    ->middleware('permission:clientes.destroy');
