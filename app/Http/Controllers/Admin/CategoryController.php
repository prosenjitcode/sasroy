<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Events\OrderShipped;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Http\Resources\CategoryResource;
use App\Mail\OrderdMail;
use Illuminate\Support\Facades\Mail;

use function Termwind\render;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return CategoryResource::collection(Category::orderBy('id', 'DESC')->get());
    }

    public function productsByCategory(Category $category)
    {

        return ProductResource::collection($category->products);
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
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => ['required'],
            'imageUrl' => ['required', 'image', 'mimes:jpeg,jpg,png,webp'],

        ]);
        $data = '';
        if ($request->file('imageUrl')) {
            $file = $request->file('imageUrl');
            $filename = time() . $file->getClientOriginalName();
            $file->move(public_path('images/category'), $filename);
            $data = url('images/category/' . $filename);
        }

        $category = Category::create([
            'name' => $request->name,
            'imageUrl' => $data,
        ]);
        if ($category) {

            return new CategoryResource($category);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        return new CategoryResource($category);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function updateCategory(Request $request, Category $category)
    {
        $this->validate($request, [
            'name' => ['required', 'string'],
            'imageUrl' => empty($request->imageUrl) ? '' : ['image', 'mimes:jpeg,jpg,png,webp'],
        ]);

        $data = '';
        if ($request->file('imageUrl')) {
            $file = $request->file('imageUrl');
            $filename = time() . $file->getClientOriginalName();
            $file->move(public_path('images/category'), $filename);
            $data = url('images/category/' . $filename);
        }

        $categorytup = $category->update(
            [
                'name' => $request->name,
                'imageUrl' => empty($data) ? $category->imageUrl : $data,
            ]
        );
        if ($categorytup) {

            return new CategoryResource($category);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        //
    }
}
