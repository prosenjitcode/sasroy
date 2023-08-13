<?php

namespace App\Http\Controllers\Admin;

use App\Events\OrderShipped;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Http\Requests\UpdateProductRequest;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        
        return ProductResource::collection(Product::orderBy('id','DESC')->paginate());
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
            'category_id' => ['required'],
            'title' => ['required', 'string'],
            'autor' => ['required', 'string'],
            'publishDate' => ['required', 'string'],
            'description' => ['required', 'string',],
            'price' => ['required'],
            'discount' => ['required'],
            'pages' => ['required'],
            'language' => ['required', 'string'],
            'imageUrl'=>['required','image','mimes:jpeg,jpg,png,webp'],
            
        ]);
        $data='';
        if ($request->file('imageUrl'))
        {
          $file = $request->file('imageUrl');
          $filename = time().$file->getClientOriginalName();
          $file->move(public_path('images/product'),$filename);
          $data = url('images/product/'.$filename);
        }

        $product = Product::create([
            'category_id' => $request->category_id,
            'title' => $request->title,
            'autor' => $request->autor,
            'publishDate' => $request->publishDate,
            'description' => $request->description,
            'price' => $request->price,
            'discount' => $request->discount,
            'pages' => $request->pages,
            'language' => $request->language,
            'imageUrl' => $data,
            'stock' => 10,
        ]);
        if ($product) {
           
            return new ProductResource($product);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return new ProductResource($product);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {

       
    }

    public function updateProduct(Request $request, Product $product)
    {
        $this->validate($request, [
            'category_id' => ['required'],
            'title' => ['required', 'string'],
            'autor' => ['required', 'string'],
            'publishDate' => ['required', 'string'],
            'description' => ['required', 'string',],
            'price' => ['required'],
            'discount' => ['required'],
            'pages' => ['required'],
            'imageUrl'=>empty($request->imageUrl)?'':['image','mimes:jpeg,jpg,png,webp'],
            'language' => ['required', 'string'],
        ]);

       $data = '';
        if ($request->file('imageUrl'))
        {
          $file = $request->file('imageUrl');
          $filename = time().$file->getClientOriginalName();
          $file->move(public_path('images/product'),$filename);
          $data = url('images/product/'.$filename);
        }

        $productup = $product->update(
            [
                'category_id' => $request->category_id,
                'title' => $request->title,
                'autor' => $request->autor,
                'publishDate' => $request->publishDate,
                'description' => $request->description,
                'price' => $request->price,
                'discount' => $request->discount,
                'pages' => $request->pages,
                'language' => $request->language,
                'imageUrl' => empty($data)?$product->imageUrl:$data,
                'stock' => 10,
            ]
        );
        if ($productup) {
            return new ProductResource($product);
        }


       
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
    }
}
