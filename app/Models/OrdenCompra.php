<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class OrdenCompra extends Model
{
    use HasFactory;

    protected $fillable = [
        'proveedor_id',
        'condiciones_pagos_id',
        'descripcion',
        'neto',
        'iva',
        'total',
        'estado',
    ];

    public function detalleOrdenCompra(): HasMany
    {
        return $this->hasMany(DetalleOrdenCompra::class);
    }
}
