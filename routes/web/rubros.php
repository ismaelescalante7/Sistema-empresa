<?php

use App\Http\Controllers\RubroController;
use Illuminate\Support\Facades\Route;

Route::get('/rubros', [RubroController::class, 'index'])
    ->name('rubros.index')
    ->middleware('permission:rubros.index');

Route::get('/rubros/create', [RubroController::class, 'create'])
    ->name('rubros.create')
    ->middleware('permission:rubros.create');

Route::post('/rubros/store', [RubroController::class, 'store'])
    ->name('rubros.store')
    ->middleware('permission:rubros.create');

Route::get('/rubros/{rubro}/edit', [RubroController::class, 'edit'])
    ->name('rubros.edit')
    ->middleware('permission:rubros.edit');

Route::patch('/rubros/{rubro}', [RubroController::class, 'update'])
    ->name('rubros.update')
    ->middleware('permission:rubros.edit');

Route::delete('rubros/{rubro}', [RubroController::class, 'destroy'])
    ->name('rubros.destroy')
    ->middleware('permission:rubros.destroy');