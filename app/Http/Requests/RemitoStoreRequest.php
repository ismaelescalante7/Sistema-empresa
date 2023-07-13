<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RemitoStoreRequest extends FormRequest
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
            'numero' => [
                'required',
                'integer'
            ],
            'fecha_ingreso' => [
                'required',
                'date',
                'after_or_equal:today'
            ],
            'proveedor_id' => [
                'required',
                'integer',
                'exists:App\Models\Proveedor,id'
            ],
            'localidad_id' => [
                'required',
                'integer',
                'exists:App\Models\Localidad,id'
            ],
            'user_id' => [
                'required',
                'integer',
                'exists:App\Models\User,id'
            ],
            'ordenCompras' => [
                'nullable',
                'array'
            ],
            'ordenCompras.*.orden_compra_id' => [
                'required',
                'integer',
                'exists:App\Models\OrdenCompra,id'
            ],
            'detalles' => 'required|array',
            'detalles.*.producto_id' => [
                'required',
                'integer',
                'exists:App\Models\Producto,id'
            ],
            'detalles.*.orden_compra_id' => [
                'nullable',
                'integer',
                'exists:App\Models\OrdenCompra,id'
            ],
            'detalles.*.cantidad_pendiente' => [
                'required',
                'integer',
                'min:0'
            ],
            'detalles.*.cantidad' => [
                'required',
                'integer',
                'min:1'
            ],
        ];
    }
}
