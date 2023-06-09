<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrdenCompraHeadStoreRequest extends FormRequest
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
            'proveedor_id' => [
                'required',
                'integer',
                'exists:App\Models\Proveedor,id'
            ],
            'condiciones_pagos_id' => [
                'required',
                'integer',
                'exists:App\Models\CondicionesPago,id'
            ],
            'descripcion' => [
                'required',
            ],
            'fecha' => [
                'required',
                'date',
                'after_or_equal:today'
            ],
        ];
    }
}
