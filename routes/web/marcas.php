<?php

use App\Http\Controllers\MarcaController;
use Illuminate\Support\Facades\Route;

Route::get('/marcas', [MarcaController::class, 'index'])
    ->name('marcas.index')
    ->middleware('permission:marcas.index');
