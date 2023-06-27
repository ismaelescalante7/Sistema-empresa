<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\OrdenCompraDetalleStoreRequest;
use App\Http\Requests\OrdenCompraHeadStoreRequest;

class OrdenCompraController extends Controller
{
    public function processHead(OrdenCompraHeadStoreRequest $request) {
        $data = $request->validated();
        return response($data);
    }

    public function processDetalle(OrdenCompraDetalleStoreRequest $request) {
        $data = $request->validated();
        return response($data);
    }
}
