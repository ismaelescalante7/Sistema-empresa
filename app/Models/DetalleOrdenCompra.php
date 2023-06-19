<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleOrdenCompra extends Model
{
    use HasFactory;

    protected $fillable = [
        'orden_compra_id',
        'precio_compra',
        'cantidad',
        'cantidad_pendiente',
        'cantidad_baja'
    ];
    




}
