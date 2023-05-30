<?php

namespace App\Http\Controllers;

use App\Http\Requests\PlanCuentaStoreRequest;
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

    public function create(): Response
    {
        return Inertia::render('PlanesCuentas/Create');
    }

    public function store(PlanCuentaStoreRequest $request) 
    {
        $data = $request->validated();
        PlanCuenta::create($data);
        return redirect()->route('planes.cuentas.index');
    }

    public function edit(PlanCuenta $planCuenta) 
    {
        return Inertia::render('PlanesCuentas/Update', compact('planCuenta'));
    }
}
