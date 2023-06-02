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
        $data = $request->validated();
        Marca::create($data);
        return redirect()->route('marcas.index');
    }

    public function edit(Marca $marca): Response
    {
        return Inertia::render('Marcas/Update', compact('marca'));
    }

    public function update(Marca $marca, MarcaStoreRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $marca->update($data);
        return redirect()->route('marcas.index');   
    }

    public function destroy(Marca $marca): RedirectResponse
    {
        $marca->delete();
        return redirect()->route('marcas.index');
    }
}
