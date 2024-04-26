<?php
namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class LoginResponseResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'code' => 200,
            'access_token' => $this->resource['token'],
            'token_type' => 'Bearer'
        ];
    }
}
