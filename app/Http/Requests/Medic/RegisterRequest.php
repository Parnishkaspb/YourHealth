<?php

namespace App\Http\Requests\Medic;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    // public function authorize(): bool
    // {
    //     return false;
    // }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $medicId = optional(auth()->user())->id;

        return [
            'login' => ['required', 'string', 'max:255', Rule::unique('medics')->ignore($medicId)],
            'name' => ['required', 'string', 'max:255'],
            'surname' => ['required', 'string', 'max:255'],
            'telephone' => ['required', 'string', Rule::unique('medics')->ignore($medicId)],
            'email' => ['required', 'email', 'string', Rule::unique('medics')->ignore($medicId)],
            'id_profile_ambulance' => ['required']
        ];
    }
}
