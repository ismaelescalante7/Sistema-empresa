<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductoRequest;
use App\Models\Categoria;
use App\Models\Marca;
use App\Models\Producto;
use App\Models\RetencionGanancia;
use App\Models\RetencionIngresosBruto;
use App\Models\Rubro;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class ProductoController extends Controller
{
    public function index(Request $request): Response
    {
        $filters = $request->only('nombre');
        $productos = Producto::mainSearch(collect($filters))
            ->orderBy('nombre')
            ->paginate(config('custom.pagination.per_page'));
        return Inertia::render('Productos/List', compact('productos', 'filters'));
    }

    public function create() {
        $categorias = Categoria::all();
        $marcas = Marca::all();
        $rubros = Rubro::all();
        $retencionGanancias = RetencionGanancia::all();
        $retencionIngresosBrutos = RetencionIngresosBruto::all();
        return Inertia::render('Productos/Create', compact(
            'categorias', 
            'marcas', 
            'rubros', 
            'retencionGanancias',
            'retencionIngresosBrutos'
        ));
    }

    public function store(StoreProductoRequest $request) 
    {
        $data = $request->validated();
        Producto::create($data);
        return redirect()->route('productos.index');
    }
}           
