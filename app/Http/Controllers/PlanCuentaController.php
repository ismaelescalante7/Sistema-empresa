<?php

namespace App\Http\Controllers;

use App\Models\PlanCuenta;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class PlanCuentaController extends Controller
{
    public function index(Request $request): Response
    {
        $filters = $request->only(['descripcion']);
        $planesCuentas = PlanCuenta::where('descripcion', 'like', "%{$request->get('descripcion')}%")
            ->orderBy('descripcion')
            ->paginate(config('custom.pagination.per_page'));

        return Inertia::render('PlanesCuentas/List', [
            'planesCuentas' => $planesCuentas,
            'filters' => $filters
        ]);
    }
}
