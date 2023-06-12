<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect('/login');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');

    # Configuración
    Route::group([], __DIR__ . '/web/tipos_comprobantes.php');
    Route::group([], __DIR__ . '/web/retenciones_ganancias.php');
    Route::group([], __DIR__ . '/web/condiciones_ivas.php');
    Route::group([], __DIR__ . '/web/planes_cuentas.php');
    Route::group([], __DIR__ . '/web/medidas.php');
    Route::group([], __DIR__ . '/web/retencion_ingresos_bruto.php');
    Route::group([], __DIR__ . '/web/formas_pagos.php');
    Route::group([], __DIR__ . '/web/retencion_ingresos_bruto.php');
    Route::group([], __DIR__ . '/web/condiciones_pago.php');
  
    ## Profile
    Route::group([], __DIR__ . '/web/profile.php');

    Route::group([], __DIR__ . '/web/users.php');
    Route::group([], __DIR__ . '/web/roles.php');
    Route::group([], __DIR__ . '/web/clientes.php');
  
    # Inventario
    Route::group([], __DIR__ . '/web/marcas.php');
    Route::group([], __DIR__ . '/web/productos.php');
    Route::group([], __DIR__ . '/web/depositos.php');
    Route::group([], __DIR__ . '/web/rubros.php');
    Route::group([], __DIR__ . '/web/proveedores.php');
    Route::group([], __DIR__ . '/web/ordenes_compras.php');
    Route::group([], __DIR__ . '/web/remitos.php');
});
