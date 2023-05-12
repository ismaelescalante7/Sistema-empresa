<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RoleStoreRequest extends FormRequest
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
            'name' => [
                'required',
                'alpha_num',
                'unique:roles,name',
            ],
            'description' => [
                'required',
                'unique:roles,description',
                'regex:/^[\pL\s\d]+$/u'
            ],
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'abreviatura',
            'description' => 'nombre de rol'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'El campo :attribute es requerido.',
            'description.required' => 'El :attribute es requerido.',
            'name.unique' => 'El campo :attribute ya está en uso.',
            'description.unique' => 'El :attribute ya está en uso.',
            'name.alpha_num' => 'El campo :attribute no debe contener espacios ni caracteres especiales.',
            'description.regex' => 'El :attribute no debe contener caracteres especiales.'
        ];
    }
}
