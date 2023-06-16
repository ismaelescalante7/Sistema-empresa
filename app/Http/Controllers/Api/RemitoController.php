<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\RemitoStoreRequest;
use Illuminate\Http\Request;

class RemitoController extends Controller
{
    public function processHead(RemitoStoreRequest $request) {
        $data = $request->validated();
        return response($data);
    }
}
