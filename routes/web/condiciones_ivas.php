<?php

use App\Http\Controllers\CondicionIvaController;
use Illuminate\Support\Facades\Route;

Route::get('/condiciones-ivas', [CondicionIvaController::class, 'index'])
    ->name('condiciones.ivas.index')
    ->middleware('permission:condiciones.ivas.index');
