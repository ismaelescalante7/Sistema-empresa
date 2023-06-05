<?php

namespace App\Http\Controllers;

use App\Http\Requests\RubroStoreRequest;
use App\Models\Rubro;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class RubroController extends Controller
{
    public function index(Request $request): Response
    {

        $filters = $request->only(['nombre']);
        $rubros = Rubro::where('nombre', 'like', "%{$request->get('nombre')}%")
            ->orderBy('nombre')
            ->paginate(config('custom.pagination.per_page'));
            
        return Inertia::render('Rubros/List', compact('rubros','filters'));
    }


    public function create(): Response
    {
        return Inertia::render('Rubros/Create');
    }

    public function store(RubroStoreRequest $request): RedirectResponse
    {
        $data = $request->validated();
        Rubro::create($data);
        return redirect()->route('rubros.index');
    }

    public function edit(Rubro $rubro): Response
    {
        return Inertia::render('Rubros/Update', compact('rubro'));
    }

    public function update(Rubro $rubro, RubroStoreRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $rubro->update($data);
        return redirect()->route('rubros.index');   
    }

    public function destroy(Rubro $rubro): RedirectResponse
    {
        $rubro->delete();
        return redirect()->route('rubros.index');
    }
}
