<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Resources\CartResource;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\AddCartRequestForm;
use App\Http\Resources\ProductResource;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return CartResource::collection(Cart::where('user_id',Auth::user()->id)->get());
        
        
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
    public function store(AddCartRequestForm $request)
    {
        $request->validated($request->all());
        $cart = Cart::where(['user_id'=>Auth::user()->id,'product_id'=>$request->productId])->first();
        if (!$cart) {
            $cart = Cart::create([
                'user_id' => Auth::user()->id,
                'product_id' => $request->productId,
            ]);
            if ($cart) {
                return new CartResource($cart);
            }
        }else{
            return response()->json(['message'=>'Already add to cart.']);
        }
       

      
    }

    public function isCart(Request $request) {
        if(Cart::where(['user_id'=>Auth::user()->id,'product_id'=>$request->id])->first()){
            return response()->json(['message'=>'true']);
        }else{
           return response()->json(['message'=>'false']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Cart $cart)
    {
         if(Cart::where(['user_id'=>Auth::user()->id,'product_id'=>$cart->product_id])->first()){
            return response()->json(['message'=>'true']);
         }else{
            return response()->json(['message'=>'false']);
         }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cart $cart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cart $cart)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cart $cart)
    {
       if ( $cart->user_id==Auth::user()->id) {
        $cart->delete();
        return response()->json([
            'message'=>'Removed'
        ]);
       }else{
        return response()->json([
            'message'=>'Unauthorized.']);
       }
      
    }
}
