<?php

namespace App\Http\Resources\Medic;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class VisitsResponceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'datetomedic' => $this->datetomedic,
            'timetomedic' => $this->timetomedic,
            'visit' => $this->visit,
            'user_name' => $this->user->name,
            'user_surname' => $this->user->surname
        ];
    }
}
