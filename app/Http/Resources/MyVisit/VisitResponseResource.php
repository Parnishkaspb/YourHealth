<?php

namespace App\Http\Resources\MyVisit;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class VisitResponseResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'date' => $this->resource['date'],
            'time' => $this->resource['time'],
            'visit' => $this->visit,
            'name_doctor' => $this->medic->name,
            'surname_doctor' => $this->medic->surname,
        ];
    }
}
