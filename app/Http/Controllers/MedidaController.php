<?php

namespace App\Http\Controllers;

use App\Http\Requests\MedidaStoreRequest;
use App\Models\Medida;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class MedidaController extends Controller
{
    public function index(Request $request): Response
    {

        $filters = $request->only(['descripcion']);
        $medidas = Medida::where('descripcion', 'like', "%{$request->get('descripcion')}%")
            ->orderBy('descripcion')
            ->paginate(config('custom.pagination.per_page'));

        return Inertia::render('Medidas/List', compact('medidas','filters'));
    }

    public function create(): Response
    {
        return Inertia::render('Medidas/Create');
    }

    public function store(MedidaStoreRequest $request): RedirectResponse
    {
        try {
            $data = $request->validated();
            Medida::create($data);
            flashAlert(__('messages.success', ['Action' => 'Creación', 'element' => 'Medida']));
        } catch (\Exception $exception) {
            logger($exception->getMessage());
            flashAlert(
                __('messages.failure', ['action' => 'Creación', 'element' => 'Medida']),
                'danger'
            );
        }
        return redirect()->route('medidas.index');
    }

    public function edit(Medida $medida): Response
    {
        return Inertia::render('Medidas/Update', compact('medida'));
    }

    public function update(Medida $medida, MedidaStoreRequest $request): RedirectResponse
    {
        try {
            $data = $request->validated();
            $medida->update($data);
            flashAlert(__('messages.success', ['Action' => 'Modificación', 'element' => 'Medida']));
        } catch (\Exception $exception) {
            logger($exception->getMessage());
            flashAlert(
                __('messages.failure', ['action' => 'Modificación', 'element' => 'Medida']),
                'danger'
            );
        }
       
        return redirect()->route('medidas.index');   
    }

    public function destroy(Medida $medida): RedirectResponse
    {
        try {
            $medida->delete();
            flashAlert(__('messages.success', ['Action' => 'Eliminación', 'element' => 'Medida']));
        } catch (\Exception $exception) {
            logger($exception->getMessage());
            flashAlert(
                __('messages.failure', ['action' => 'Eliminación', 'element' => 'Medida']),
                'danger'
            );
        }
        
        return redirect()->route('medidas.index');
    }
}
