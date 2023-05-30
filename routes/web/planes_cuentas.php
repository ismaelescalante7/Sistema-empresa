<?php

use App\Http\Controllers\PlanCuentaController;
use Illuminate\Support\Facades\Route;

Route::get('/planes-cuentas', [PlanCuentaController::class, 'index'])
    ->name('planes.cuentas.index')
    ->middleware('permission:planes.cuentas.index');
