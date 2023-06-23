<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrdenCompraStoreRequest extends FormRequest
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
            'proveedor_id' => 'required|exists:proveedors,id',
            'condiciones_pagos_id' => [
                'required',
                'integer',
                'exists:App\Models\CondicionesPago,id'
            ],
            'descripcion' => [
                'required',
            ],
            'neto' => 'required|numeric',
            'iva' => 'required|numeric',
            'total' => 'required|numeric',
            'detalles' => 'required|array',
            'detalles.*.producto_id' => 'required|numeric',
            'detalles.*.cantidad' => 'required|numeric',
            'detalles.*.cantidad_pendiente' => 'required|numeric',
            'detalles.*.subtotal' => 'required|numeric',
            'detalles.*.subtotal_impuestos' => 'required|numeric',
            'detalles.*.precio_compra' => 'required|numeric'
        ];
    }
}
