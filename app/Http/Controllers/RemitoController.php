<?php

namespace App\Http\Controllers;

use App\Http\Requests\RemitoStoreRequest;
use App\Models\Localidad;
use App\Models\OrdenCompra;
use App\Models\Producto;
use App\Models\Proveedor;
use App\Models\Remito;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class RemitoController extends Controller
{
    public function index(Request $request): Response
    {
        $filters = $request->only(['localidad_id']);
        $remitos = Remito::where('localidad_id', 'like', "%{$request->get('localidad_id')}%")
            ->orderBy('localidad_id')
            ->with(['proveedor:id,razon_social', 'localidad:id,nombre'])
            ->paginate(config('custom.pagination.per_page'));

        return Inertia::render('Remitos/List', compact('remitos', 'filters'));
    }

    public function create(): Response
    {
        $user = auth()->user();
        $localidades = Localidad::all();
        $proveedores = Proveedor::all();
        $productos = Producto::all();
        $ordenCompras = OrdenCompra::with('detalleOrdenCompra.producto')->get();
        return Inertia::render('Remitos/Create', compact('localidades', 'proveedores','ordenCompras','productos', 'user'));
    }

    public function store(RemitoStoreRequest $request): RedirectResponse
    {
        try {
            $data = $request->validated();
            Remito::create($data);
            flashAlert(__('messages.success', ['Action' => 'Creación', 'element' => 'Remito']));
        } catch (\Exception $exception) {
            logger($exception->getMessage());
            flashAlert(
                __('messages.failure', ['action' => 'Creación', 'element' => 'Remito']),
                'danger'
            );
        }
        return redirect()->route('remitos.index');
    }

    public function edit(Remito $remito): Response
    {
        return Inertia::render('Remitos/Update', compact('remito'));
    }

    public function update(Remito $remito, RemitoStoreRequest $request): RedirectResponse
    {
        try {
            $data = $request->validated();
            $remito->update($data);
            flashAlert(__('messages.success', ['Action' => 'Modificación', 'element' => 'Remito']));
        } catch (\Exception $exception) {
            logger($exception->getMessage());
            flashAlert(
                __('messages.failure', ['action' => 'Modificación', 'element' => 'Remito']),
                'danger'
            );
        }

        return redirect()->route('remitos.index');
    }

    public function destroy(Remito $remito): RedirectResponse
    {
        try {
            $remito->delete();
            flashAlert(__('messages.success', ['Action' => 'Eliminación', 'element' => 'Remito']));
        } catch (\Exception $exception) {
            logger($exception->getMessage());
            flashAlert(
                __('messages.failure', ['action' => 'Eliminación', 'element' => 'Remito']),
                'danger'
            );
        }

        return redirect()->route('remitos.index');
    }
}
