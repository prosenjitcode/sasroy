<?php

namespace App\Http\Controllers;

use App\Models\Address;
use Illuminate\Http\Request;
use App\Traits\HttpResponses;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\AddressResource;
use App\Http\Requests\AddressRequestForm;
use App\Http\Requests\UpdateAddressRequest;

class AddressController extends Controller
{
    use HttpResponses;
    public function index()
    {
        
        return AddressResource::collection(Address::where('user_id',Auth::user()->id)->get());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AddressRequestForm $request)
    {
        $request->validated($request->all());
        $address = Address::create([
            'user_id' => Auth::user()->id,
            'name' => $request->name,
            'phone_no' => $request->phoneNo,
            'address' => $request->address,
            'city' => $request->city,
            'pincode' => $request->pincode,
            'state' => $request->state,
            'area' => $request->area,
        ]);

        if ($address) {
            return new AddressResource($address);
        }
       
    } 

    /**
     * Display the specified resource.
     */
    public function show(Address $address)
    {
        if (Auth::user()->id!=$address->user_id) {
            return $this->error('Unauthorized.',401);
        }

        return new AddressResource($address);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAddressRequest $request, Address $address)
    {
        if (Auth::user()->id!=$address->user_id) {
            return $this->error('Unauthorized.',401);
        }
        $request->validated($request->all());
        $address->update($request->all());
        return new AddressResource($address);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Address $address)
    {
        //
    }
}
