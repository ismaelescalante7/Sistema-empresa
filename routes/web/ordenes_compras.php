<?php

use App\Http\Controllers\OrdenCompraController;
use Illuminate\Support\Facades\Route;

Route::get('/orden-compras', [OrdenCompraController::class, 'index'])
    ->name('orden.compras.index')
    ->middleware('permission:orden.compras.index');

Route::get('/orden-compras/create', [OrdenCompraController::class, 'create'])
    ->name('orden.compras.create')
    ->middleware('permission:orden.compras.create');

Route::get('/orden-compras/create/detalles', [OrdenCompraController::class, 'createDetalles'])
    ->name('orden.compras.create.detalles')
    ->middleware('permission:orden.compras.create');

Route::post('/orden-compras/store', [OrdenCompraController::class, 'store'])
    ->name('orden.compras.store')
    ->middleware('permission:orden.compras.create');

Route::get('/orden-compras/{ordenCompra}/show', [OrdenCompraController::class, 'show'])
    ->name('orden.compras.show')
    ->middleware('permission:orden.compras.show');

Route::get('/orden-compras/{ordenCompra}/edit', [OrdenCompraController::class, 'edit'])
    ->name('orden.compras.edit')
    ->middleware('permission:orden.compras.edit');

Route::patch('/orden-compras/{ordenCompra}', [OrdenCompraController::class, 'update'])
    ->name('orden.compras.update')
    ->middleware('permission:orden.compras.edit');

Route::delete('orden-compras/{ordenCompra}', [OrdenCompraController::class, 'destroy'])
    ->name('orden.compras.destroy')
    ->middleware('permission:orden.compras.destroy');

Route::get('orden-compras/{ordenCompra}/download', [OrdenCompraController::class, 'downloadPdf'])
    ->name('orden.compras.download.pdf');

