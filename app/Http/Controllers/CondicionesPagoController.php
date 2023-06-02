<?php

namespace App\Http\Controllers;

use App\Http\Requests\CondicionesPagoStoreRequest;
use App\Models\CondicionesPago;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class CondicionesPagoController extends Controller
{
    public function index(Request $request): Response
    {
        $filters = $request->only(['condicion']);
        $condicionesPagos = CondicionesPago::where('condicion', 'like', "%{$request->get('condicion')}%")
        ->orderBy('condicion')
        ->paginate(config('custom.pagination.per_page'));

        return Inertia::render('CondicionesPagos/List', [
            'condicionesPagos' => $condicionesPagos,
            'filters' => $filters
        ]);
    }

    public function create(): Response
    {
        return Inertia::render('CondicionesPagos/Create');
    }

    public function store(CondicionesPagoStoreRequest $request): RedirectResponse
    {
        $data = $request->validated();
        CondicionesPago::create($data);
        return redirect()->route('condiciones.pagos.index');
    }

    public function edit(CondicionesPago $condicionesPago): Response
    {
        return Inertia::render('CondicionesPagos/Update', compact('condicionesPago'));
    }

    public function update(CondicionesPago $condicionesPago, CondicionesPagoStoreRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $condicionesPago->update($data);
        return redirect()->route('condiciones.pagos.index');
    }

    public function destroy(CondicionesPago $condicionesPago): RedirectResponse
    {
        $condicionesPago->delete();
        return redirect()->route('condiciones.pagos.index');
    }
}
