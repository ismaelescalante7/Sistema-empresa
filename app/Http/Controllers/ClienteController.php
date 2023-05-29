<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClienteSearchRequest;
use App\Models\Cliente;
use App\Models\Departamento;
use App\Models\Localidad;
use App\Models\Provincia;
use App\Models\TipoDocumento;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ClienteSearchRequest $request): Response
    {
        $filters = $request->only(['apellido_nombre', 'numero_documento']);
        $clientes = Cliente::mainSearch(collect($filters))
            ->orderBy('apellido_nombre')
            ->with(['provincia','departamento','localidad'])
            ->paginate(config('custom.pagination.per_page'));
        return Inertia::render('Clientes/List', [
            'clientes' => $clientes,
            'filters' => $filters
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() : Response
    {
        $tiposDocumentos = TipoDocumento::all();
        $provincias = Provincia::all();
        $departamentos = Departamento::all();
        $localidades = Localidad::all();
        $provinciaDefault = config('custom.provincia_salta.id');
        return Inertia::render('Clientes/Create', compact([
            'tiposDocumentos', 'provincias', 'departamentos', 'localidades', 'provinciaDefault'
        ]));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function show(Cliente $cliente) : Response
    {
        $cliente = $cliente->load(['tipoDocumento', 'provincia', 'departamento', 'localidad']);
        return Inertia::render('Clientes/Show', compact('cliente'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function edit(Cliente $cliente)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cliente $cliente)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cliente $cliente): RedirectResponse
    {
        $cliente->delete();
        return Redirect::route('clientes.index');
    }
}
