<?php

namespace App\Http\Resources;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Resources\PaymentResource;
use Illuminate\Http\Resources\Json\JsonResource;

class TermResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public static $wrap = 'term';
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'term' => $this->term

        ];
    }
}
