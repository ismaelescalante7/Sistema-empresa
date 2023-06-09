<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrdenCompraStoreRequest;
use App\Models\CondicionesPago;
use App\Models\OrdenCompra;
use App\Models\Proveedor;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class OrdenCompraController extends Controller
{
    public function index(Request $request): Response
    {
        $filters = $request->only(['descripcion']);
        $ordenCompras = OrdenCompra::where('descripcion', 'like', "%{$request->get('descripcion')}%")
            ->orderBy('descripcion')
            ->paginate(config('custom.pagination.per_page'));

        return Inertia::render('OrdenCompras/List', [
            'ordenCompras' => $ordenCompras,
            'filters' => $filters
        ]);
    }

    public function create(): Response
    {
        $proveedores = Proveedor::all();
        $condicionesPagos = CondicionesPago::all();
        return Inertia::render('OrdenCompras/Head', compact('proveedores', 'condicionesPagos'));
    }

    public function createDetalles(): Response
    {
        $proveedores = Proveedor::all();
        $condicionesPagos = CondicionesPago::all();
        return Inertia::render('OrdenCompras/Detalle', compact('proveedores', 'condicionesPagos'));

    }

    public function store(OrdenCompraStoreRequest $request): RedirectResponse
    {
        try {
            $data = $request->validated();
            OrdenCompra::create($data);
            flashAlert(__('messages.success', ['Action' => 'Creación', 'element' => 'Orden de Compra']));
        } catch (\Exception $exception) {
            logger($exception->getMessage());
            flashAlert(
                __('messages.failure', ['action' => 'Creación', 'element' => 'Orden de Compra']),
                'danger'
            );
        }
        return redirect()->route('orden.compras.index');
    }

    public function edit(OrdenCompra $ordenCompra): Response
    {
        $proveedores = Proveedor::all();
        $condicionesPagos = CondicionesPago::all();
        return Inertia::render('OrdenCompras/Update', compact('ordenCompra', 'proveedores', 'condicionesPagos'));
    }

    public function update(OrdenCompra $ordenCompra, OrdenCompraStoreRequest $request): RedirectResponse
    {
        try {
            $data = $request->validated();
            $ordenCompra->update($data);
            flashAlert(__('messages.success', ['Action' => 'Modificación', 'element' => 'Orden de Compra']));
        } catch (\Exception $exception) {
            logger($exception->getMessage());
            flashAlert(
                __('messages.failure', ['action' => 'Modificación', 'element' => 'Orden de Compra']),
                'danger'
            );
        }
        return redirect()->route('orden.compras.index');
    }

    public function destroy(OrdenCompra $ordenCompra): RedirectResponse
    {
        try {
            $ordenCompra->delete();
            flashAlert(__('messages.success', ['Action' => 'Eliminación', 'element' => 'Orden de Compra']));
        } catch (\Exception $exception) {
            logger($exception->getMessage());
            flashAlert(
                __('messages.failure', ['action' => 'Eliminación', 'element' => 'Orden de Compra']),
                'danger'
            );
        }
        return redirect()->route('orden.compras.index');
    }
}
