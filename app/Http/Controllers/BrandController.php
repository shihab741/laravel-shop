<?php

namespace App\Http\Controllers;

use App\Brand;
use Image;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $brands = Brand::all();
        return view('admin.brand.brand', ['brands' => $brands]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $image = $request->file('brand_image');
        $imageName = $image->getClientOriginalName();
        $directory = 'uploads/brand-images/';
        $imageUrl = $directory.$imageName;

        while(file_exists($imageUrl))
        {
            $imageNameWithoutExtension = basename($imageName, '.'.$image->getClientOriginalExtension());
            $imageName = $imageNameWithoutExtension.'-copy'.'.'.$image->getClientOriginalExtension();
            $imageUrl = $directory.$imageName;
        }

        Image::make($image)->resize(600,400)->save($imageUrl);

        $brand = new Brand();
        $brand->brand_name = $request->brand_name;
        $brand->brand_desc = $request->brand_desc;
        $brand->brand_image = $imageName;
        $brand->status = $request->status;
        $brand->save();

        return redirect()->back()->with('message', '<div class="alert alert-success" role="alert">Brand added successfully!</div>'); 
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $brand = Brand::find($id);
        return view('admin.brand.edit', ['brand' => $brand]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function edit(Brand $brand)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $brand = Brand::find($request->id);
        $image = $request->file('brand_image');

        if ($image) {
            unlink('uploads/brand-images/'.$brand->brand_image);

            $imageName = $image->getClientOriginalName();
            $directory = 'uploads/brand-images/';
            $imageUrl = $directory.$imageName;

            while(file_exists($imageUrl))
            {
                $imageNameWithoutExtension = basename($imageName, '.'.$image->getClientOriginalExtension());
                $imageName = $imageNameWithoutExtension.'-copy'.'.'.$image->getClientOriginalExtension();
                $imageUrl = $directory.$imageName;
            }            

            Image::make($image)->resize(600,400)->save($imageUrl);

            $brand->brand_name = $request->brand_name;
            $brand->brand_desc = $request->brand_desc;
            $brand->brand_image = $imageName;
            $brand->status = $request->status;
            $brand->save();
        } 
        else 
        {
            $brand->brand_name = $request->brand_name;
            $brand->brand_desc = $request->brand_desc;
            $brand->status = $request->status;
            $brand->save();
        }

        return redirect('brand')->with('message', '<div class="alert alert-success" role="alert">Brand information updated successfully!</div>');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $brand = Brand::find($id);
        if($brand->brand_image)
        {
            unlink('uploads/brand-images/'.$brand->brand_image);
            $brand->delete();
        }
        else
        {
            $brand->delete();
        }
        
        return redirect()->back()->with('message', '<div class="alert alert-success" role="alert">Brand deleted successfully!</div>');
    }

    public function publish($id)
    {
        $brand = Brand::find($id);
        $brand->status = 1;
        $brand->save();

        return redirect()->back()->with('message', '<div class="alert alert-success" role="alert"> Published successfully!</div>');
    }

    public function unpublish($id)
    {
        $brand = Brand::find($id);
        $brand->status = 0;
        $brand->save();

        return redirect()->back()->with('message', '<div class="alert alert-success" role="alert">Unublished successfully!</div>');
    }    
}
