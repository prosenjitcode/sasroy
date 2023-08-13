<?php

namespace App\Http\Controllers;

use Razorpay\Api\Api;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\PaymentGateway;

class PayController extends Controller
{
  public $api;
  public $RAZORPAY_KEY_ID;
  public $RAZORPAY_KEY_SECRET;

  public function __construct()
  {
    $paymentGateway = PaymentGateway::whereId('1')->first();
    $this->RAZORPAY_KEY_ID= $paymentGateway->razorpay_key_id;
    $this->RAZORPAY_KEY_SECRET= $paymentGateway->razorpay_secret_id;

    $this->api = new Api($this->RAZORPAY_KEY_ID, $this->RAZORPAY_KEY_SECRET);
  }

  public function Orders(Request $request)
  {


    $orderData = [
      'amount'          => ((int)$request->amount) * 100, // 2000 rupees in paise
      'currency'        => 'INR',
      'payment_capture' => 1 // auto capture
    ];

    $order = $this->api->order->create($orderData);
    $item = [
      'order_id' => $order['id'],
      'razorpay_key_id' => $this->RAZORPAY_KEY_ID,
      'entity' => $order['entity'],
      'amount' => $order['amount'],
      'amount_paid' => $order['amount_paid'],
      'amount_due' => $order['amount_due'],
      'currency' => $order['currency'],
      'receipt' => $order['receipt'],
      'offer_id' => $order['offer_id'],
      'status' => $order['status'],
      'attempts' => $order['attempts'],
      'notes' => $order['notes'],
      'created_at' => $order['created_at'],
    ];

    return response()->json(
      $item
    );
  }

  public function verifyPaymentSignature(Request $request)
  {
   $verifyP = $this->api->utility->verifyPaymentSignature(array(
      'razorpay_order_id' => $request->orderId,
       'razorpay_payment_id' => $request->paymentId,
        'razorpay_signature' => $request->signature
      ));

      if ($verifyP) {
        return "Payment successfull..";
      }
  }
}
