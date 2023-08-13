<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'bookId',
        'addressId',
        'qty',
        'totalPrice',
        'orderDate',
        'packDate',
        'shippingDate',
        'deliveryDate',
        'status',
        'payment',
        'razorpay_payment_id',
        'razorpay_order_id',
        'razorpay_signature',
    ];



    public function user() {
        return $this->belongsTo(User::class);
     }
}
