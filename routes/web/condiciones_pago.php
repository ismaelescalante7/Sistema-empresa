<?php

use App\Http\Controllers\CondicionesPagoController;
use Illuminate\Support\Facades\Route;

Route::get('/condiciones-pagos', [CondicionesPagoController::class, 'index'])
    ->name('condiciones.pagos.index')
    ->middleware('permission:condiciones.pagos.index');

Route::get('/condiciones-pagos/create', [CondicionesPagoController::class, 'create'])
    ->name('condiciones.pagos.create')
    ->middleware('permission:condiciones.pagos.create');

Route::post('/condiciones-pagos/store', [CondicionesPagoController::class, 'store'])
    ->name('condiciones.pagos.store')
    ->middleware('permission:condiciones.pagos.create');

Route::get('/condiciones-pagos/{condicionesPago}/edit', [CondicionesPagoController::class, 'edit'])
    ->name('condiciones.pagos.edit')
    ->middleware('permission:condiciones.pagos.edit');

Route::patch('/condiciones-pagos/{condicionesPago}', [CondicionesPagoController::class, 'update'])
    ->name('condiciones.pagos.update')
    ->middleware('permission:condiciones.pagos.edit');

Route::delete('condiciones-pagos/{condicionesPago}', [CondicionesPagoController::class, 'destroy'])
    ->name('condiciones.pagos.destroy')
    ->middleware('permission:condiciones.pagos.destroy');
    