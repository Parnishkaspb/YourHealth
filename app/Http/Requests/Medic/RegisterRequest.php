<?php

namespace App\Http\Requests\Medic;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $medicId = optional(auth()->user())->id;

        return [
            'login' => ['required', 'string', 'max:255', Rule::unique('users')->ignore($medicId)],
            'password' => ['required'],
            'name' => ['required', 'string', 'max:255'],
            'surname' => ['required', 'string', 'max:255'],
            'telephone' => ['required', 'string', Rule::unique('users')->ignore($medicId)],
            'passport' => ['required', 'string', Rule::unique('users')->ignore($medicId)],
            'address' => ['required', 'string', Rule::unique('users')->ignore($medicId)],
        ];
    }
}
