<?php

namespace App\Http\Controllers;

use App\Http\Requests\CondicionIvaStoreRequest;
use App\Http\Requests\CondicionIvaUpdateRequest;
use App\Models\CondicionIva;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class CondicionIvaController extends Controller
{
    public function index(Request $request): Response
    {
        $filters = $request->only(['descripcion']);
        $condicionesIvas = CondicionIva::where('descripcion', 'like', "%{$request->get('descripcion')}%")
            ->orderBy('descripcion')
            ->paginate(config('custom.pagination.per_page'));
            
        return Inertia::render('CondicionesIvas/List', compact('condicionesIvas', 'filters'));
    }

    public function create(): Response
    {
        return Inertia::render('CondicionesIvas/Create');
    }

    public function store(CondicionIvaStoreRequest $request): RedirectResponse
    {
        try {
            $data = $request->validated();
            CondicionIva::create($data);
            flashAlert(__('messages.success', ['Action' => 'Creación', 'element' => 'Condición Iva']));
        } catch (\Exception $exception) {
            logger($exception->getMessage());
            flashAlert(
                __('messages.failure', ['action' => 'Creación', 'element' => 'Condición Iva']),
                'danger'
            );
        }
        return redirect()->route('condiciones.ivas.index');
    }

    public function edit(CondicionIva $condicionIva): Response
    {
        return Inertia::render('CondicionesIvas/Update', compact('condicionIva'));
    }

    public function update(CondicionIva $condicionIva, CondicionIvaUpdateRequest $request): RedirectResponse
    {
        try {
            $data = $request->validated();
            $condicionIva->update($data);
            flashAlert(__('messages.success', ['Action' => 'Modificación', 'element' => 'Condición Iva']));
        } catch (\Exception $exception) {
            logger($exception->getMessage());
            flashAlert(
                __('messages.failure', ['action' => 'Modificación', 'element' => 'Condición Iva']),
                'danger'
            );
        }
       
        return redirect()->route('condiciones.ivas.index');   
    }

    public function destroy(CondicionIva $condicionIva): RedirectResponse
    {
        try {
            $condicionIva->delete();
            flashAlert(__('messages.success', ['Action' => 'Eliminación', 'element' => 'Condición Iva']));
        } catch (\Exception $exception) {
            logger($exception->getMessage());
            flashAlert(
                __('messages.failure', ['action' => 'Eliminación', 'element' => 'Condición Iva']),
                'danger'
            );
        }
        
        return redirect()->route('condiciones.ivas.index');
    }
}
