<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
