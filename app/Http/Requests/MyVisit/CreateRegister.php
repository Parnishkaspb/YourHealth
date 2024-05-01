<?php

namespace App\Http\Requests\MyVisit;

use Illuminate\Foundation\Http\FormRequest;

class CreateRegister extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'id_medic' => ['required', 'exists:medics,id'],
            'datetomedic' => ['required', 'date'],
            'timetomedic' => ['required', 'regex:/^\d{2}:\d{2}$/'],
        ];
    }
}
