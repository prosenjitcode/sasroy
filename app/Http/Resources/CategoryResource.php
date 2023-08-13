<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use App\Http\Resources\ProductResource;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return  ['id'=>$this->id,
        'name'=>$this->name,
        'imageUrl'=>$this->imageUrl,
       'totalProduct'=>count(ProductResource::collection($this->products)),
    ];
    }
}
