<?php

use App\Http\Controllers\PlanCuentaController;
use Illuminate\Support\Facades\Route;

Route::get('/planes-cuentas', [PlanCuentaController::class, 'index'])
    ->name('planes.cuentas.index')
    ->middleware('permission:planes.cuentas.index');

Route::get('/planes-cuentas/create', [PlanCuentaController::class, 'create'])
    ->name('planes.cuentas.create')
    ->middleware('permission:planes.cuentas.create');

Route::post('/planes-cuentas/store', [PlanCuentaController::class, 'store'])
    ->name('planes.cuentas.store')
    ->middleware('permission:planes.cuentas.create');

Route::get('/planes-cuentas/{planCuenta}/edit', [PlanCuentaController::class, 'edit'])
    ->name('planes.cuentas.edit')
    ->middleware('permission:planes.cuentas.edit');

Route::patch('/planes-cuentas/{planCuenta}', [PlanCuentaController::class, 'update'])
    ->name('planes.cuentas.update')
    ->middleware('permission:planes.cuentas.edit');

Route::delete('planes-cuentas/{planCuenta}', [PlanCuentaController::class, 'destroy'])
    ->name('planes.cuentas.destroy')
    ->middleware('permission:planes.cuentas.destroy');
    