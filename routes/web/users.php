<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/users', [UserController::class, 'index'])
    ->name('users.index')
    ->middleware('permission:users.index');

Route::get('/users/create', [UserController::class, 'create'])
    ->name('users.create')
    ->middleware('permission:users.create');

Route::post('/users', [UserController::class, 'store'])
    ->name('users.store')
    ->middleware('permission:users.create');

Route::get('/users/{user}/edit', [UserController::class, 'edit'])
    ->name('users.edit')
    ->middleware('permission:users.edit');

Route::patch('/users/{user}', [UserController::class, 'update'])
    ->name('users.update')
    ->middleware('permission:users.edit');

Route::post('/users/{user}/image-upload', [UserController::class, 'uploadImage'])
    ->name('users.upload.image');

