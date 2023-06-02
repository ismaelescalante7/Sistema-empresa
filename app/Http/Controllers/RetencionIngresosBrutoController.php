<?php

namespace App\Http\Controllers;

use App\Http\Requests\RetencionIngresosBrutoStoreRequest;
use App\Models\RetencionIngresosBruto;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class RetencionIngresosBrutoController extends Controller
{
    public function index(Request $request): Response
    {
        $filters = $request->only(['descripcion']);
        $retensionIngresosBruto = RetencionIngresosBruto::where('descripcion', 'like', "%{$request->get('descripcion')}%")
            ->orderBy('descripcion')
            ->paginate(config('custom.pagination.per_page'));

        return Inertia::render('RetencionIngresosBruto/List', [
            'retensionIngresosBruto' => $retensionIngresosBruto,
            'filters' => $filters
        ]);
    }

    public function create(): Response
    {
        return Inertia::render('RetencionIngresosBruto/Create');
    }

    public function store(RetencionIngresosBrutoStoreRequest $request): RedirectResponse
    {
        $data = $request->validated();
        RetencionIngresosBruto::create($data);
        return redirect()->route('retencion.ingresos.bruto.index');
    }

    public function edit(RetencionIngresosBruto $retencionIngresosBruto): Response
    {
        return Inertia::render('RetencionIngresosBruto/Update', compact('retencionIngresosBruto'));
    }

    public function update(RetencionIngresosBruto $retencionIngresosBruto, RetencionIngresosBrutoStoreRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $retencionIngresosBruto->update($data);
        return redirect()->route('retencion.ingresos.bruto.index');
    }

    public function destroy(RetencionIngresosBruto $retencionIngresosBruto): RedirectResponse
    {
        $retencionIngresosBruto->delete();
        return redirect()->route('retencion.ingresos.bruto.index');
    }
}
