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
            ->with(['rubro','marca'])
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
        try {
            $data = $request->validated();
            Producto::create($data);
            flashAlert(__('messages.success', ['Action' => 'Creación', 'element' => 'Producto']));
        } catch (\Exception $exception) {
            logger($exception->getMessage());
            flashAlert(
                __('messages.failure', ['action' => 'Creación', 'element' => 'Producto']),
                'danger'
            );
        }
        return redirect()->route('productos.index');
    }

    public function show(Producto $producto) : Response
    {
        $producto->load(['rubro', 'marca', 'retencionGanancia', 'retencionIngresosBruto']);
        return Inertia::render('Productos/Show', compact('producto'));
    }
}           
