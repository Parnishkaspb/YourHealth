<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'login' => 'required',
            'password' => 'required|min:6'
        ];
    }
    public function messages()
    {
        return [
            'login.required' => 'Логин обязателен для входа.',
            'password.required' => 'Пароль обязателен для входа.'
        ];
    }
}
