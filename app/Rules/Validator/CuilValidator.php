<?php

namespace App\Rules\Validator;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class CuilValidator implements ValidationRule
{
    protected $dni;
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $this->passes($attribute, $value) ? null : $fail($this->message());
    }

    public function __construct($dni)
    {
        $this->dni = $dni;
    }

    public function passes($attribute, $value)
    {
        // Verifica que el CUIL contenga el DNI
        return strpos($value, strval($this->dni)) !== false;
    }

    public function message()
    {
        return 'El campo :attribute debe contener el número de DNI.';
    }
}
