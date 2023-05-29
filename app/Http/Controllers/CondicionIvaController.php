<?php

namespace App\Http\Controllers;

use App\Models\CondicionIva;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class CondicionIvaController extends Controller
{
    public function index() : Response
    {
        $condicionesIvas = CondicionIva::orderBy('codigo')
            ->paginate(config('custom.pagination.per_page'));;
            
        return Inertia::render('CondicionesIvas/List', [
            'condicionesIvas' => $condicionesIvas
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
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
     * @param  \App\Models\CondicionIva  $condicionIva
     * @return \Illuminate\Http\Response
     */
    public function show(CondicionIva $condicionIva)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CondicionIva  $condicionIva
     * @return \Illuminate\Http\Response
     */
    public function edit(CondicionIva $condicionIva)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CondicionIva  $condicionIva
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CondicionIva $condicionIva)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CondicionIva  $condicionIva
     * @return \Illuminate\Http\Response
     */
    public function destroy(CondicionIva $condicionIva)
    {
        //
    }
}
