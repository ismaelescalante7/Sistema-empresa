<?php

use App\Http\Controllers\LocalidadController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

/**
 * Add protected api end points here
 */
Route::name('api.')->middleware('auth:sanctum')->group(function () {
    // @TODO create protected endpoints

    /*     Route::get(
        '/orden-compra/process-head',
        [\App\Http\Controllers\Api\OrdenCompraController::class, 'processHead']
    )->name('orden.compra.process.head'); */
});

Route::post(
    '/orden-compra/process-head',
    [\App\Http\Controllers\Api\OrdenCompraController::class, 'processHead']
)->name('orden.compra.process.head');


Route::post('/orden-compra/process-detalle', [\App\Http\Controllers\Api\OrdenCompraController::class, 'processDetalle'])->name('orden.compra.process.detalle');

Route::post(
    '/remito/process-head',
    [\App\Http\Controllers\Api\RemitoController::class, 'processHead']
)->name('remito.process.head');

Route::post(
    '/remito/process-detalle',
    [\App\Http\Controllers\Api\RemitoController::class, 'processDetalle']
)->name('remito.process.detalle');