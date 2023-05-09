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
        'nombre',
        'descripcion',
        'precio',
        'cantidad'
    ];

    public function scopeMainSearch(Builder $query, Collection $data): Builder
    {
        if ($data->get('nombre')) {
            $query->where('nombre', 'like', "%{$data->get('nombre')}%");
        }
        return $query;
    }
}
