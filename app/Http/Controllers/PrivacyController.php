<?php

namespace App\Http\Controllers;

use App\Models\Privacy;
use Illuminate\Http\Request;
use App\Http\Resources\PrivacyResource;

class PrivacyController extends Controller
{
    
    public function index() {
        return new PrivacyResource(Privacy::whereId('1')->first());
    }

    public function store(Request $request)
    {

        $request->validate([
            'privacy' => ['required', 'string'],
        ]);
        if (Privacy::create($request->all())) {
            return response()->json([
                'message' => true
            ]);
        }
    }

    public function update(Request $request,$id)
    {
       

       Privacy::findOrFail($id)->first()->fill(['privacy'=>$request->privacy])->save();
        
            return response()->json([
                'message' => true
            ]);
        
    }
}
