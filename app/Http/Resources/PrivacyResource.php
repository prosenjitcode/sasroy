<?php

namespace App\Http\Resources;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PrivacyResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public static $wrap = 'privacy';
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'privacy' => $this->privacy

        ];
    }
}
