<?php

namespace App\Http\Controllers;

use App\Http\Requests\MarcaStoreRequest;
use App\Models\Marca;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class MarcaController extends Controller
{
    public function index(Request $request): Response
    {

        $filters = $request->only(['nombre']);
        $marcas = Marca::where('nombre', 'like', "%{$request->get('nombre')}%")
            ->orderBy('nombre')
            ->paginate(config('custom.pagination.per_page'));
            
        return Inertia::render('Marcas/List', compact('marcas','filters'));
    }


    public function create(): Response
    {
        return Inertia::render('Marcas/Create');
    }

    public function store(MarcaStoreRequest $request): RedirectResponse
    {
        try {
            $data = $request->validated();
            Marca::create($data);
            flashAlert(__('messages.success', ['Action' => 'Creación', 'element' => 'Marca']));
        } catch (\Exception $exception) {
            logger($exception->getMessage());
            flashAlert(
                __('messages.failure', ['action' => 'Creación', 'element' => 'Marca']),
                'danger'
            );
        }
        
        return redirect()->route('marcas.index');
    }

    public function edit(Marca $marca): Response
    {
        return Inertia::render('Marcas/Update', compact('marca'));
    }

    public function update(Marca $marca, MarcaStoreRequest $request): RedirectResponse
    {
        try {
            $data = $request->validated();
            $marca->update($data);
            flashAlert(__('messages.success', ['Action' => 'Modificación', 'element' => 'Marca']));
        } catch (\Exception $exception) {
            logger($exception->getMessage());
            flashAlert(
                __('messages.failure', ['action' => 'Modificación', 'element' => 'Marca']),
                'danger'
            );
        }
       
        return redirect()->route('marcas.index');   
    }

    public function destroy(Marca $marca): RedirectResponse
    {
        try {
            $marca->delete();
            flashAlert(__('messages.success', ['Action' => 'Eliminación', 'element' => 'Marca']));
        } catch (\Exception $exception) {
            logger($exception->getMessage());
            flashAlert(
                __('messages.failure', ['action' => 'Eliminación', 'element' => 'Marca']),
                'danger'
            );
        }
        
        return redirect()->route('marcas.index');
    }
}
