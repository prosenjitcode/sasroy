<?php

namespace App\Http\Controllers;

use App\Models\PaymentGateway;
use Illuminate\Http\Request;

class PaymentGatewayController extends Controller
{

    public function index() {
        return response()->json(['data'=>PaymentGateway::whereId('1')->first()]);
    }

    public function store(Request $request)
    {

        $request->validate([
            'razorpay_key_id' => ['required', 'string'],
            'razorpay_secret_id' => ['required', 'string'],
        ]);
        if (PaymentGateway::create($request->all())) {
            return response()->json([
                'message' => true
            ]);
        }
    }

    public function update(Request $request,$id)
    {
       

       PaymentGateway::findOrFail($id)->first()->fill($request->all())->save();
        
            return response()->json([
                'message' => true
            ]);
        
    }
}
