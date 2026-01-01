<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ClientResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'ic' => $this->ic,
            'passport' => $this->passport,
            'country' => $this->country,
            'address_1' => $this->address_1,
            'address_2' => $this->address_2,
            'address_3' => $this->address_3,
            'city' => $this->city,
            'state' => $this->state,
            'zip' => $this->zip,
            'created_by' => new UserResource($this->whenLoaded('created_by')),
            'updated_by' => new UserResource($this->whenLoaded('updated_by')),
        ];
    }
}
