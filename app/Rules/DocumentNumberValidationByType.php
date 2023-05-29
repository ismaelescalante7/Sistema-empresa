<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class DocumentNumberValidationByType implements Rule
{
    protected $tipoDocumentoId;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($tipoDocumentoId)
    {
        $this->tipoDocumentoId = $tipoDocumentoId;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        if (is_null($this->tipoDocumentoId)) {
            return ctype_digit($value)
                ? preg_match('/^\d{7,8}$/', $value)
                : preg_match('/^[A-Za-z0-9]{6,15}$/', $value);
        }
        return in_array($this->tipoDocumentoId, config('custom.tipos_documentos.alfanumericos'), true)
            ? preg_match('/^[A-Za-z0-9]{6,15}$/', $value)
            : preg_match('/^\d{7,8}$/', $value);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return in_array($this->tipoDocumentoId, config('custom.tipos_documentos.alfanumericos'), true)
            ? 'El campo :Attribute puede ser alfanumérico, entre 6 y 15 caracteres.'
            : 'El campo :Attribute debe ser numérico, entre 7 y 8 dígitos.';
    }
}