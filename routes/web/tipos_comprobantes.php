<?php

use App\Http\Controllers\TipoComprobanteController;
use Illuminate\Support\Facades\Route;

Route::get('/tipos-comprobantes', [TipoComprobanteController::class, 'index'])
    ->name('tipos.comprobantes.index')
    ->middleware('permission:tipos.comprobantes.index');
