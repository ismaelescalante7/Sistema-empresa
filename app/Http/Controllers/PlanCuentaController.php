<?php

namespace App\Http\Controllers;

use App\Http\Requests\PlanCuentaStoreRequest;
use App\Models\PlanCuenta;
use Illuminate\Http\RedirectResponse;
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

    public function store(PlanCuentaStoreRequest $request): RedirectResponse
    {
        try {
            $data = $request->validated();
            PlanCuenta::create($data);
            flashAlert(__('messages.success', ['Action' => 'Creación', 'element' => 'Plan de Cuenta']));
        } catch (\Exception $exception) {
            logger($exception->getMessage());
            flashAlert(
                __('messages.failure', ['action' => 'Creación', 'element' => 'Plan de Cuenta']),
                'danger'
            );
        }
        return redirect()->route('planes.cuentas.index');
    }

    public function edit(PlanCuenta $planCuenta): Response
    {
        return Inertia::render('PlanesCuentas/Update', compact('planCuenta'));
    }

    public function update(PlanCuenta $planCuenta, PlanCuentaStoreRequest $request): RedirectResponse
    {
        try {
            $data = $request->validated();
            $planCuenta->update($data);
            flashAlert(__('messages.success', ['Action' => 'Modificación', 'element' => 'Plan de Cuenta']));
        } catch (\Exception $exception) {
            logger($exception->getMessage());
            flashAlert(
                __('messages.failure', ['action' => 'Modificación', 'element' => 'Plan de Cuenta']),
                'danger'
            );
        }
        return redirect()->route('planes.cuentas.index');   
    }

    public function destroy(PlanCuenta $planCuenta): RedirectResponse
    {
        try {
            $planCuenta->delete();
            flashAlert(__('messages.success', ['Action' => 'Eliminación', 'element' => 'Plan de Cuenta']));
        } catch (\Exception $exception) {
            logger($exception->getMessage());
            flashAlert(
                __('messages.failure', ['action' => 'Eliminación', 'element' => 'Plan de Cuenta']),
                'danger'
            );
        }
        return redirect()->route('planes.cuentas.index');
    }
}