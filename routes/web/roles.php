<?php

use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use Illuminate\Support\Facades\Route;

Route::get('/roles', [RoleController::class, 'index'])
    ->name('roles.index')
    ->middleware('permission:roles.index');

Route::get('/roles/create', [RoleController::class, 'create'])
    ->name('roles.create')
    ->middleware('permission:roles.create');

Route::post('/roles', [RoleController::class, 'store'])
    ->name('roles.store')
    ->middleware('permission:roles.create');

Route::get('/roles/{role}/edit', [RoleController::class, 'edit'])
    ->name('roles.edit')
    ->middleware('permission:roles.edit');

Route::patch('/roles/{role}', [RoleController::class, 'update'])
    ->name('roles.update')
    ->middleware('permission:roles.edit');

Route::delete('/roles/{role}', [RoleController::class, 'destroy'])
    ->name('roles.destroy')
    ->middleware('permission:roles.destroy');


Route::get('roles/{role}/permissions', [PermissionController::class, 'index'])
    ->name('roles.permissions.index')
    ->middleware('permission:roles.permissions.index');

Route::get('roles/{role}/permissions/edit', [PermissionController::class, 'edit'])
    ->name('roles.permissions.edit')
    ->middleware('permission:roles.permissions.edit');

Route::patch('roles/{role}/permissions', [PermissionController::class, 'update'])
    ->name('roles.permissions.update')
    ->middleware('permission:roles.permissions.edit');