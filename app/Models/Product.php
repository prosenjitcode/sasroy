<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'title',
        'autor',
        'language',
        'publishDate',
        'description',
        'imageUrl',
        'price',
        'discount',
        'pages',
        'stock',
    ];
    function category()
    {
        return $this->belongsTo(Category::class);
    }
    function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'carts', 'user_id', 'product_id');
    }
}
