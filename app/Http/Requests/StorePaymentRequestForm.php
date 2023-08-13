<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePaymentRequestForm extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $user = $this->user();
        if ($user != null && $user->tokenCan('user')) {
            return true;
        }

        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'bookId' => ['required'],
            'addressId' => ['required'],
            'qty' => ['required'],
            'totalPrice' => ['required'],
            'orderDate' => ['required'],
            'packDate' => ['required'],
            'shippingDate' => ['required'],
            'deliveryDate' => ['required'],
            'status' => ['required'],
            'payment' => ['required'],
            'razorpay_payment_id' => ['required'],
            'razorpay_order_id' => ['required'],
            'razorpay_signature' => ['required'],
        ];
    }
}
