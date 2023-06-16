<?php

namespace App\Http\Controllers;

use App\Models\Localidad;
use Illuminate\Http\Request;

class LocalidadController extends Controller
{
    public function index(Request $request)
    {
        dd($request->all());
        $localidades = Localidad::where('nombre', 'like', "%{$request->get('nombre')}%")
            ->get();

        return response()->json(['localidades' => $localidades]);
    }
}
