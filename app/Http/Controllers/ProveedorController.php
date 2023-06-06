<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProveedorStoreRequest;
use App\Models\CondicionIva;
use App\Models\Localidad;
use App\Models\PlanCuenta;
use App\Models\Proveedor;
use App\Models\Provincia;
use App\Models\RetencionGanancia;
use App\Models\RetencionIngresosBruto;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class ProveedorController extends Controller
{
    public function index(Request $request): Response
    {
        $filters = $request->only(['razon_social']);
        $proveedores = Proveedor::where('razon_social', 'like', "%{$request->get('razon_social')}%")
            ->orderBy('razon_social')
            ->paginate(config('custom.pagination.per_page'));

        return Inertia::render('Proveedores/List', [
            'proveedores' => $proveedores,
            'filters' => $filters
        ]);
    }

    public function create(): Response
    {
        return Inertia::render('Proveedores/Create', [
            'condicionesIva' => CondicionIva::all(),
            'provincias' => Provincia::all(),
            'localidades' => Localidad::all(),
            'retencionesIngresosBruto' => RetencionIngresosBruto::all(),
            'retencionGanancias' => RetencionGanancia::all(),
            'planCuentas' => PlanCuenta::all(),
        ]);
    }

    public function store(ProveedorStoreRequest $request): RedirectResponse
    {
        $data = $request->validated();
        Proveedor::create($data);
        return redirect()->route('proveedores.index');
    }

    public function edit(Proveedor $proveedor): Response
    {
        return Inertia::render('Proveedores/Update', [
            'condicionesIva' => CondicionIva::all(),
            'provincias' => Provincia::all(),
            'localidades' => Localidad::all(),
            'retencionesIngresosBruto' => RetencionIngresosBruto::all(),
            'retencionGanancias' => RetencionGanancia::all(),
            'planCuentas' => PlanCuenta::all(),
            'proveedor' => $proveedor
        ]);
    }

    public function update(Proveedor $proveedor, ProveedorStoreRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $proveedor->update($data);
        return redirect()->route('proveedores.index');
    }

    public function destroy(Proveedor $proveedor): RedirectResponse
    {
        $proveedor->delete();
        return redirect()->route('proveedores.index');
    }
}
