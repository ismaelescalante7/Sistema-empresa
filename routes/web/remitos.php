<?php

use App\Http\Controllers\RemitoController;
use Illuminate\Support\Facades\Route;

Route::get('/remitos', [RemitoController::class, 'index'])
    ->name('remitos.index')
    ->middleware('permission:remitos.index');

Route::get('/remitos/create', [RemitoController::class, 'create'])
    ->name('remitos.create')
    ->middleware('permission:remitos.create');

Route::post('/remitos/store', [RemitoController::class, 'store'])
    ->name('remitos.store')
    ->middleware('permission:remitos.create');

Route::get('/remitos/{remito}/edit', [RemitoController::class, 'edit'])
    ->name('remitos.edit')
    ->middleware('permission:remitos.edit');

Route::patch('/remitos/{remito}', [RemitoController::class, 'update'])
    ->name('remitos.update')
    ->middleware('permission:remitos.edit');

Route::delete('remitos/{remito}', [RemitoController::class, 'destroy'])
    ->name('remitos.destroy')
    ->middleware('permission:remitos.destroy');