<?php

use App\Http\Controllers\ChangePasswordController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/profile', [ProfileController::class, 'show'])
    ->name('profile.show');

// Cambio de password
Route::get('/change-password', [ChangePasswordController::class, 'showChangePasswordForm'])
    ->name('change.password');

Route::post('/change-password', [ChangePasswordController::class, 'changePassword'])
    ->name('change.password.store');