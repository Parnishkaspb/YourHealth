<?php
namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RegisterRequest extends FormRequest
{
    public function rules(): array
    {
        $userId = optional(auth()->user())->id;

        return [
            'login' => ['required', 'string', 'max:255', Rule::unique('users')->ignore($userId)],
            'password' => ['required'],
            'name' => ['required', 'string', 'max:255'],
            'surname' => ['required', 'string', 'max:255'],
            'telephone' => ['required', 'string', Rule::unique('users')->ignore($userId)],
            'passport' => ['required', 'string', Rule::unique('users')->ignore($userId)],
            'address' => ['required', 'string', Rule::unique('users')->ignore($userId)],
        ];
    }
}

