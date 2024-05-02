<?php

namespace App\Http\Resources\Codes;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UnprocessableContentResponseResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'message' => $this->message,
            'code' => 422
        ];
    }
}
