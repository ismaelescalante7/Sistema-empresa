<?php

namespace App\Http\Requests;

use App\Rules\DocumentNumberValidationByType;
use Illuminate\Foundation\Http\FormRequest;

class ClienteSearchRequest extends FormRequest
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
            'apellido_nombre' => [
                'nullable',
                'string',
                'regex:/^[\pL\s\-]+$/u'
            ],
            'numero_documento' => [
                'nullable',
                new DocumentNumberValidationByType(null)
            ]
        ];
    }
}
