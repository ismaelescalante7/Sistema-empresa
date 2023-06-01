<?php

use App\Http\Controllers\MedidaController;
use Illuminate\Support\Facades\Route;

Route::get('/medidas', [MedidaController::class, 'index'])
    ->name('medidas.index')
    ->middleware('permission:medidas.index');
