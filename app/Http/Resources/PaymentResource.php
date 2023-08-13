<?php

namespace App\Http\Resources;

use App\Models\Address;
use App\Models\User;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PaymentResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        
        $product = Product::find($this->bookId);
        $user = User::find($this->user_id);
        $address = Address::find($this->addressId);
        return [
            'id' => $this->id,
            'user' => new UserResource($user),
            'item' => new ProductResource($product) ,
            'address' => new AddressResource($address) ,
            'qty' => $this->qty,
            'totalPrice' => $this->totalPrice,
            'orderDate' => $this->orderDate,
            'packDate' => $this->packDate,
            'shippingDate' => $this->shippingDate,
            'status' => $this->status,
            'payment' => $this->payment,
            'razorpay_payment_id' => $this->razorpay_payment_id,
            'razorpay_order_id' => $this->razorpay_order_id,
            'razorpay_signature' => $this->razorpay_signature,
        ];
    }

   
}
