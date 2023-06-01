<?php

use App\Http\Controllers\FormasPagosController;
use Illuminate\Support\Facades\Route;

Route::get('/formas-pagos', [FormasPagosController::class, 'index'])
    ->name('formas.pagos.index')
    ->middleware('permission:formas.pagos.index');

Route::get('/formas-pagos/create', [FormasPagosController::class, 'create'])
    ->name('formas.pagos.create')
    ->middleware('permission:formas.pagos.create');

Route::post('/formas-pagos/store', [FormasPagosController::class, 'store'])
    ->name('formas.pagos.store')
    ->middleware('permission:formas.pagos.create');

Route::get('/formas-pagos/{formasPago}/edit', [FormasPagosController::class, 'edit'])
    ->name('formas.pagos.edit')
    ->middleware('permission:formas.pagos.edit');

Route::patch('/formas-pagos/{formasPago}', [FormasPagosController::class, 'update'])
    ->name('formas.pagos.update')
    ->middleware('permission:formas.pagos.edit');

Route::delete('formas-pagos/{formasPago}', [FormasPagosController::class, 'destroy'])
    ->name('formas.pagos.destroy')
    ->middleware('permission:formas.pagos.destroy');
    