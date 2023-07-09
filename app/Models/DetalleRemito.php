<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DetalleRemito extends Model
{
    use HasFactory;

    protected $fillable = [
        'producto_id',
        'cantidad',
        'cantidad_pendiente',
        'remito_id',
        'orden_compra_id'
    ];
    
    public function producto(): BelongsTo
    {
        return $this->belongsTo(Producto::class);
    }
}
