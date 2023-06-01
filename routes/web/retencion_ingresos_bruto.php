<?php

use App\Http\Controllers\RetencionIngresosBrutoController;
use Illuminate\Support\Facades\Route;

Route::get('/retencion-ingresos-bruto', [RetencionIngresosBrutoController::class, 'index'])
    ->name('retencion.ingresos.bruto.index')
    ->middleware('permission:retencion.ingresos.bruto.index');

Route::get('/retencion-ingresos-bruto/create', [RetencionIngresosBrutoController::class, 'create'])
    ->name('retencion.ingresos.bruto.create')
    ->middleware('permission:retencion.ingresos.bruto.create');

Route::post('/retencion-ingresos-bruto/store', [RetencionIngresosBrutoController::class, 'store'])
    ->name('retencion.ingresos.bruto.store')
    ->middleware('permission:retencion.ingresos.bruto.create');

Route::get('/retencion-ingresos-bruto/{retencionIngresosBruto}/edit', [RetencionIngresosBrutoController::class, 'edit'])
    ->name('retencion.ingresos.bruto.edit')
    ->middleware('permission:retencion.ingresos.bruto.edit');

Route::patch('/retencion-ingresos-bruto/{retencionIngresosBruto}', [RetencionIngresosBrutoController::class, 'update'])
    ->name('retencion.ingresos.bruto.update')
    ->middleware('permission:retencion.ingresos.bruto.edit');

Route::delete('retencion-ingresos-bruto/{retencionIngresosBruto}', [RetencionIngresosBrutoController::class, 'destroy'])
    ->name('retencion.ingresos.bruto.destroy')
    ->middleware('permission:retencion.ingresos.bruto.destroy');
    