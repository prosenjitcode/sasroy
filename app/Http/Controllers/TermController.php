<?php

namespace App\Http\Controllers;

use App\Http\Resources\TermResource;
use App\Models\Term;
use Illuminate\Http\Request;

class TermController extends Controller
{
    public function index() {
        return new TermResource(Term::whereId('1')->first());
    }

    public function store(Request $request)
    {

        $request->validate([
            'term' => ['required', 'string'],
        ]);
        if (Term::create($request->all())) {
            return response()->json([
                'message' => true
            ]);
        }
    }

    public function update(Request $request,$id)
    {
       

       Term::findOrFail($id)->first()->fill(['term'=>$request->term])->save();
        
            return response()->json([
                'message' => true
            ]);
        
    }
}
