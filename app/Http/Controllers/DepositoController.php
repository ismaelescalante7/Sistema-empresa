<?php

namespace App\Http\Controllers;

use App\Http\Requests\DepositoStoreRequest;
use App\Models\Deposito;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class DepositoController extends Controller
{
    public function index(Request $request): Response
    {

        $filters = $request->only(['nombre']);
        $depositos = Deposito::where('nombre', 'like', "%{$request->get('nombre')}%")
            ->orderBy('nombre')
            ->paginate(config('custom.pagination.per_page'));
            
        return Inertia::render('Depositos/List', compact('depositos','filters'));
    }


    public function create(): Response
    {
        return Inertia::render('Depositos/Create');
    }

    public function store(DepositoStoreRequest $request): RedirectResponse
    {
        $data = $request->validated();
        Deposito::create($data);
        return redirect()->route('depositos.index');
    }

    public function edit(Deposito $deposito): Response
    {
        return Inertia::render('Depositos/Update', compact('deposito'));
    }

    public function update(Deposito $deposito, DepositoStoreRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $deposito->update($data);
        return redirect()->route('depositos.index');   
    }

    public function destroy(Deposito $deposito): RedirectResponse
    {
        $deposito->delete();
        return redirect()->route('depositos.index');
    }
}
