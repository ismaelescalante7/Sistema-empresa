<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DetalleRemitoStoreRequest extends FormRequest
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
            'producto_id' => [
                'required',
                'integer',
                'exists:App\Models\Producto,id'
            ],
            'orden_compra_id' => [
                'nullable',
                'integer',
                'exists:App\Models\OrdenCompra,id'
            ],
            'cantidad_pendiente' => [
                'required',
                'integer',
                'min:0'
            ],
            'cantidad_nueva' => [
                'required',
                'integer',
            ],
            'cantidad' => [
                'required',
                'integer',
                'min:0',
                function ($attribute, $value, $fail) {
                    $cantidadAnterior = $this->input('cantidad_nueva');

                    if ($value <= $cantidadAnterior) {
                        $fail('La cantidad debe ser menor que la cantidad anterior.');
                    }
                },
            ],
            'nombre' => [
                'required',
                'string',

            ],
        ];
    }
}
