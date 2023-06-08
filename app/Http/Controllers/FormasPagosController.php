<?php

namespace App\Http\Controllers;

use App\Http\Requests\FormasPagosStoreRequest;
use App\Models\FormasPagos;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class FormasPagosController extends Controller
{
    public function index(Request $request): Response
    {
        $filters = $request->only(['descripcion']);
        $formasPagos = FormasPagos::where('descripcion', 'like', "%{$request->get('descripcion')}%")
        ->orderBy('descripcion')
        ->paginate(config('custom.pagination.per_page'));

        return Inertia::render('FormasPagos/List', [
            'formasPagos' => $formasPagos,
            'filters' => $filters
        ]);
    }

    public function create(): Response
    {
        return Inertia::render('FormasPagos/Create');
    }

    public function store(FormasPagosStoreRequest $request): RedirectResponse
    {
        try {
            $data = $request->validated();
            FormasPagos::create($data);
            flashAlert(__('messages.success', ['Action' => 'Creación', 'element' => 'Forma de Pago']));
        } catch (\Exception $exception) {
            logger($exception->getMessage());
            flashAlert(
                __('messages.failure', ['action' => 'Creación', 'element' => 'Forma de Pago']),
                'danger'
            );
        }
        return redirect()->route('formas.pagos.index');
    }

    public function edit(FormasPagos $formasPago): Response
    {
        return Inertia::render('FormasPagos/Update', compact('formasPago'));
    }

    public function update(FormasPagos $formasPago, FormasPagosStoreRequest $request): RedirectResponse
    {
        try {
            $data = $request->validated();
            $formasPago->update($data);
            flashAlert(__('messages.success', ['Action' => 'Modificación', 'element' => 'Forma de Pago']));
        } catch (\Exception $exception) {
            logger($exception->getMessage());
            flashAlert(
                __('messages.failure', ['action' => 'Modificación', 'element' => 'Forma de Pago']),
                'danger'
            );
        }
        return redirect()->route('formas.pagos.index');   
    }

    public function destroy(FormasPagos $formasPago): RedirectResponse
    {
        try {
            $formasPago->delete();
            flashAlert(__('messages.success', ['Action' => 'Eliminación', 'element' => 'Forma de Pago']));
        } catch (\Exception $exception) {
            logger($exception->getMessage());
            flashAlert(
                __('messages.failure', ['action' => 'Eliminación', 'element' => 'Forma de Pago']),
                'danger'
            );
        }
        return redirect()->route('formas.pagos.index');
    }
}
