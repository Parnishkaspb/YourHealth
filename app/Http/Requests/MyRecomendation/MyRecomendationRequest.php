<?php

namespace App\Http\Requests\MyRecomendation;

use Illuminate\Foundation\Http\FormRequest;

class MyRecomendationRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'recomendation' => ['required']
        ];
    }
}
