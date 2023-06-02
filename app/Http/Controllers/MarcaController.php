<?php

namespace App\Http\Controllers;

use App\Models\Marca;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class MarcaController extends Controller
{
    public function index(Request $request): Response
    {

        $filters = $request->only(['nombre']);
        $marcas = Marca::where('nombre', 'like', "%{$request->get('nombre')}%")
            ->orderBy('nombre')
            ->paginate(config('custom.pagination.per_page'));
            
        return Inertia::render('Marcas/List', compact('marcas','filters'));
    }
}
