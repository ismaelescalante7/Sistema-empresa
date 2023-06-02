<?php

namespace App\Http\Controllers;

use App\Models\Medida;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class MedidaController extends Controller
{
    public function index(): Response
    {
        $medidas = Medida::orderBy('descripcion')
            ->paginate(config('custom.pagination.per_page'));

        return Inertia::render('Medidas/List', compact('medidas'));
    }

    public function create()
    {
        //
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
     * @param  \App\Models\Medida  $medida
     * @return \Illuminate\Http\Response
     */
    public function show(Medida $medida)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Medida  $medida
     * @return \Illuminate\Http\Response
     */
    public function edit(Medida $medida)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Medida  $medida
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Medida $medida)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Medida  $medida
     * @return \Illuminate\Http\Response
     */
    public function destroy(Medida $medida)
    {
        //
    }
}
