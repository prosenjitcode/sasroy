<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
        'id'=>$this->id,
        'category'=>$this->category->name,
        'categoryId'=>$this->category_id,
        'title'=>$this->title,
        'autor'=>$this->autor,
        'publishDate'=>$this->publishDate,
        'description'=>$this->description,
        'imageUrl'=>$this->imageUrl,
        'price'=>$this->price,
        'discount'=>$this->discount,
        'language'=>$this->language,
        'pages'=>$this->pages,
        'stock'=>$this->stock == 0 ? 'Out of stack' : $this->stock,
        'totalPrice'=>round((1-($this->discount/100))*$this->price,2),
        'rating'=>$this->reviews->count()>0?round($this->reviews->sum('star')/$this->reviews->count(),2):0,
        'created_at' => $this->created_at,
        'updated_at' => $this->updated_at,
        //'reviews'=>ReviewResource::collection($this->reviews),
    ];
    }
}
