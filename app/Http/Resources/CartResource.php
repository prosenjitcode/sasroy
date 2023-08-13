<?php

namespace App\Http\Resources;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CartResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $product = Product::find($this->product_id);
         return [
            'id' => $this->id,
            'itemInCart' => new ProductResource($product)

        ];
    }

   
}
