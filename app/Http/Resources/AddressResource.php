<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AddressResource extends JsonResource
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
            'userId' => $this->user_id,
            'name' => $this->name,
            'phoneNo' => $this->phone_no,
            'address' => $this->address,
            'city' => $this->city,
            'pincode' => $this->pincode,
            'state' => $this->state,
            'area' => $this->area,

        ];
    }

   
}
