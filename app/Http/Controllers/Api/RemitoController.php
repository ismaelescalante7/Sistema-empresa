<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\DetalleRemitoStoreRequest;
use App\Http\Requests\HeadRemitoStoreRequest;
use Illuminate\Http\Request;

class RemitoController extends Controller
{
    public function processHead(HeadRemitoStoreRequest $request) {
        $data = $request->validated();
        return response($data);
    }
    
    public function processDetalle(DetalleRemitoStoreRequest $request) {
        $data = $request->validated();
        return response($data);
    }
}
