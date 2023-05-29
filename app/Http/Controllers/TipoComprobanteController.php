<?php

namespace App\Http\Controllers;

use App\Models\TipoComprobante;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class TipoComprobanteController extends Controller
{
    public function index(): Response
    {
        $tiposComprobantes = TipoComprobante::orderBy('codigo')
            ->paginate(config('custom.pagination.per_page'));;

        return Inertia::render('TiposComprobantes/List', [
            'tiposComprobantes' => $tiposComprobantes
        ]);
    }
    
}
