<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

class Producto extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'codigo',
        'nombre',
        'categoria_id',
        'precio_compra',
        'precio_venta',
        'stock_minimo',
        'alicuota',
        'estado',
        'marca_id',
        'rubro_id',
        'compra',
        'vende',
        'stockeable',
        'retencion_ganancia_id',
        'retencion_ingreso_bruto_id',
        'fecha_ultima_venta'
    ];

    















    public function scopeMainSearch(Builder $query, Collection $data): Builder
    {
        if ($data->get('nombre')) {
            $query->where('nombre', 'like', "%{$data->get('nombre')}%");
        }
        return $query;
    }
}
