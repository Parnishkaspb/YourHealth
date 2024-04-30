<?php

namespace App\Http\Resources\Medic;

use App\Models\ProfileAmbulance;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MedicResource extends JsonResource
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
            'email' => $this->email,
            'telephone' => $this->telephone,
            'specialization' => $this->profileAmbulance ? $this->profileAmbulance->specialization : 'Не указано'
        ];
    }

}
