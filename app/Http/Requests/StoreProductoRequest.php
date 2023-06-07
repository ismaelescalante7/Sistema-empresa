<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'codigo' => [
                'required',
                'string'
            ],
            'nombre' => [
                'required',
                'string'
            ],
            'categoria_id' => [
                'nullable'
            ],
            'precio_venta' => [
                'required',
                'numeric'
            ],
            'precio_compra' => [
                'required',
                'numeric'
            ],
            'stock_minimo' => [
                'required',
                'numeric'
            ],
            'alicuota' => [
                'required',
                'numeric'
            ],
            'marca_id' => [
                'required',
                'integer',
                'exists:App\Models\Marca,id'
            ],
            'rubro_id' => [
                'required',
                'integer',
                'exists:App\Models\Rubro,id'
            ],
            'compra' => [
                'required',
                'in:0,1'
            ],
            'vende' => [
                'required',
                'in:0,1'
            ],
            'stockeable' => [
                'required',
                'in:0,1'
            ],
            'retencion_ganancia_id' => [
                'required',
                'integer',
                'exists:App\Models\RetencionGanancia,id'
            ],
            'retencion_ingreso_bruto_id' => [
                'required',
                'integer',
                'exists:App\Models\RetencionIngresosBruto,id'
            ],
        ];
    }
}
