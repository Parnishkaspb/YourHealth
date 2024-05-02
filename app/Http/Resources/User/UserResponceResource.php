<?php

namespace App\Http\Resources\User;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResponceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'name' => $this->name,
            'surname' => $this->surname,
            'address' => $this->address,
            'firstOrder' => $this->firstOrder,
            'passport' => $this->passport,
            'dateregister' => $this->created_at,
            "telephone" => $this->telephone,
        ];
    }
}
