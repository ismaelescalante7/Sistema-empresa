<?php

use App\Http\Controllers\RetencionGananciaController;
use Illuminate\Support\Facades\Route;

Route::get('/retenciones-ganancias', [RetencionGananciaController::class, 'index'])
    ->name('retenciones.ganancias.index')
    ->middleware('permission:retenciones.ganancias.index');
