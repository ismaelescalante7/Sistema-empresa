<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProveedorStoreRequest extends FormRequest
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
            'razon_social' => [
                'required',
            ],
            'cuit' => [
                'required'
            ],
            'numero_ingreso_bruto' => [
                'required',
                'integer'
            ],
            'condicion_iva_id' => [
                'required',
                'integer',
                'exists:App\Models\CondicionIva,id'
            ],
            'domicilio' => [
                'required'
            ],
            'telefono' => [
                'required'
            ],
            'codigo_postal' => [
                'required'
            ],
            'email' => [
                'required',
                'email'
            ],
            'provincia_id' => [
                'required',
                'integer',
                'exists:App\Models\Provincia,id'
            ],
            'localidad_id' => [
                'required',
                'integer',
                'exists:App\Models\Localidad,id'
            ],
            'retencion_ingresos_id' => [
                'required',
                'integer',
                'exists:App\Models\RetencionIngresosBruto,id'
            ],
            'cuenta_id' => [
                'required',
                'integer',
                'exists:App\Models\PlanCuenta,id'
            ],
            'retencion_ganancias_id' => [
                'required',
                'integer',
                'exists:App\Models\RetencionGanancia,id'
            ],
            'saldo' => [
                'required',
                'integer',
            ],
            'estado' => [
                'required',
                'in:0,1'
            ]
        ];
    }
}
