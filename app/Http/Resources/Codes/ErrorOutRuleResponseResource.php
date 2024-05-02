<?php

namespace App\Http\Resources\Codes;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ErrorOutRuleResponseResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'message' => 'У вас нет прав на это действие',
            'code' => 403
        ];
    }
}
