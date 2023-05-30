<?php

namespace App\Http\Controllers;

use App\Models\RetencionGanancia;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class RetencionGananciaController extends Controller
{
    public function index(): Response
    {
        $retencionesGanancias = RetencionGanancia::orderBy('codigo')
            ->paginate(config('custom.pagination.per_page'));;

        return Inertia::render('RetencionesGanancias/List', [
            'retencionesGanancias' => $retencionesGanancias
        ]);
    }
}
