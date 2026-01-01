<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ClaimResource extends JsonResource
{

    // public static $wrap = null;

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'car_registration_number' => $this->car_registration_number,
            'brand' => $this->brand,
            'model' => $this->model,
            'policy' => $this->policy,
            'insurance_company' => $this->insurance_company,
            'workshop' => $this->workshop,
            'reported_station' => $this->reported_station,
            'ic_driver' => $this->ic_driver,
            'phone_driver' => $this->phone_driver,
            'name_driver' => $this->name_driver,
            'location' => $this->location,
            'picture_root_path' => $this->picture_root_path,
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
            'updated_at' => $this->updated_at->format('Y-m-d H:i:s'),
            'created_by' => new UserResource($this->whenLoaded('created_by')),
            'updated_by' => new UserResource($this->whenLoaded('updated_by')),
        ];
    }
}
