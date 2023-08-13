<?php

namespace App\Http\Controllers;

use App\Http\Resources\BannerResource;
use App\Models\Banner;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return BannerResource::collection(Banner::latest()->get());
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
            'title' => ['required'],
            'image_url' => ['required', 'image', 'mimes:jpeg,jpg,png,webp'],

        ]);
        $data = '';
        if ($request->file('image_url')) {
            $file = $request->file('image_url');
            $filename = time() . $file->getClientOriginalName();
            $file->move(public_path('images/banner'), $filename);
            $data = url('images/banner/' . $filename);
        }

        $banner = Banner::create([
            'title' => $request->title,
            'image_url' => $data,
        ]);
        if ($banner) {

            return new BannerResource($banner);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Banner $banner)
    {
        return new BannerResource($banner);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Banner $banner)
    {
        //
    }

    public function updateBanner(Request $request, Banner $banner)
    {
        $this->validate($request, [
            'title' => ['required', 'string'],
            'image_url' => empty($request->image_url) ? '' : ['image', 'mimes:jpeg,jpg,png,webp'],
        ]);

        $data = '';
        if ($request->file('image_url')) {
            $file = $request->file('image_url');
            $filename = time() . $file->getClientOriginalName();
            $file->move(public_path('images/banner'), $filename);
            $data = url('images/banner/' . $filename);
        }

        $bannertup = $banner->update(
            [
                'title' => $request->title,
                'image_url' => empty($data) ? $banner->image_url : $data,
            ]
        );
        if ($bannertup) {

            return new BannerResource($banner);
        }
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Banner $banner)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Banner $banner)
    {
        $banner->delete();
        
    }
}
