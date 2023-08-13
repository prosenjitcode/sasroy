<?php

namespace App\Http\Controllers;

use DateTime;
use Razorpay\Api\Api;
use App\Models\Payment;
use App\Mail\OrderdMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Http\Resources\PaymentResource;
use App\Http\Requests\StorePaymentRequestForm;

class PaymentController extends Controller
{
    public $api;

  public function __construct()
  {
    $this->api = new Api(env('RAZORPAY_KEY_ID'), env('RAZORPAY_KEY_SECRET'));
  }
    public function index()
    {
        $payment = Payment::latest()->get();
       // return $this->api->order->all();
      
      
    
       // $orders = $this->api->order->all();
      //  $payments = $this->api->payment->all();

     
        return PaymentResource::collection($payment);
        
    }

    public function getOrder(Request $request) {
        $request->validate([
            'order_id'=>['required']
        ]);
         $response = $this->api->order->fetch($request->order_id);
         return response()->json(['order'=>$response->toArray()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePaymentRequestForm $request)
    {
        $request->validated($request->all());

        $payment=Payment::create([
            'user_id' => Auth::user()->id,
            'bookId' => $request->bookId,
            'addressId' => $request->addressId,
            'qty' => $request->qty,
            'totalPrice' => $request->totalPrice,
            'orderDate' => $request->orderDate,
            'packDate' => $request->packDate,
            'shippingDate' => $request->shippingDate,
            'deliveryDate' => $request->deliveryDate,
            'status' => $request->status,
            'payment' => $request->payment,
            'razorpay_payment_id' => $request->razorpay_payment_id,
            'razorpay_order_id' => $request->razorpay_order_id,
            'razorpay_signature' => $request->razorpay_signature,
        ]);

        if ($payment) {
            Mail::to('abc@inbox.mailtrap.io')->send(new OrderdMail($payment));
            return new PaymentResource($payment);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Payment $payment)
    {
        return new PaymentResource($payment);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Payment $payment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Payment $payment)
    {
        //
    }

    public function updateStatus(Request $request, Payment $payment)
    {
        if ($request->status=="ordered") {
            $payment->update([
                'status'=>"packed",
                'packDate'=>new DateTime()

            ]);
            return response()->json([
                'status'=>true
            ]);
           
        }
        if ($request->status=="packed") {
            $payment->update([
                'status'=>"shipped",
                'shippingDate'=>new DateTime()

            ]);
            return response()->json([
                'status'=>true
            ]);
        }

        if ($request->status=="shipped") {
            $payment->update([
                'status'=>"delivered",
                'deliverDate'=>new DateTime()

            ]);

            return response()->json([
                'status'=>true
            ]);
        }
       
        
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Payment $payment)
    {
        //
    }
}
