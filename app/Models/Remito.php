<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Remito extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'proveedor_id', 'localidad_id', 'fecha_ingreso', 'cerrado'];

    public function proveedor()
    {
        return $this->belongsTo(Proveedor::class);
    }

    public function localidad()
    {
        return $this->belongsTo(Localidad::class);
    }
}
