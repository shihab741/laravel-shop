<?php

namespace App\Http\Controllers;

use App\Category;
use Image;
use Illuminate\Http\Request;

class CategoryController extends Controller
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
        $categories = Category::all();
        return view('admin.category.category', ['categories' => $categories]);
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
        $image = $request->file('cat_image');
        $imageName = $image->getClientOriginalName();
        $directory = 'uploads/category-images/';
        $imageUrl = $directory.$imageName;

        while(file_exists($imageUrl))
        {
            $imageNameWithoutExtension = basename($imageName, '.'.$image->getClientOriginalExtension());
            $imageName = $imageNameWithoutExtension.'-copy'.'.'.$image->getClientOriginalExtension();
            $imageUrl = $directory.$imageName;
        }

        Image::make($image)->resize(1000,800)->save($imageUrl);

        $category = new Category();
        $category->cat_name = $request->cat_name;
        $category->cat_desc = $request->cat_desc;
        $category->cat_image = $imageName;
        $category->status = $request->status;
        $category->save();

        return redirect()->back()->with('message', '<div class="alert alert-success" role="alert">Category added successfully!</div>'); 
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category = Category::find($id);
        return view('admin.category.edit', ['category' => $category]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $category = Category::find($request->id);
        $image = $request->file('cat_image');

        if ($image) {
            unlink('uploads/category-images/'.$category->cat_image);

            $imageName = $image->getClientOriginalName();
            $directory = 'uploads/category-images/';
            $imageUrl = $directory.$imageName;

            while(file_exists($imageUrl))
            {
                $imageNameWithoutExtension = basename($imageName, '.'.$image->getClientOriginalExtension());
                $imageName = $imageNameWithoutExtension.'-copy'.'.'.$image->getClientOriginalExtension();
                $imageUrl = $directory.$imageName;
            }            

            Image::make($image)->resize(1000,800)->save($imageUrl);

            $category->cat_name = $request->cat_name;
            $category->cat_desc = $request->cat_desc;
            $category->cat_image = $imageName;
            $category->status = $request->status;
            $category->save();
        } 
        else 
        {
            $category->cat_name = $request->cat_name;
            $category->cat_desc = $request->cat_desc;
            $category->status = $request->status;
            $category->save();
        }

        return redirect('category')->with('message', '<div class="alert alert-success" role="alert">Category information updated successfully!</div>');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::find($id);
        if($category->cat_image)
        {
            unlink('uploads/category-images/'.$category->cat_image);
            $category->delete();
        }
        else
        {
            $category->delete();
        }
        
        return redirect()->back()->with('message', '<div class="alert alert-success" role="alert">Category deleted successfully!</div>');
    }


    public function publish($id)
    {
        $category = Category::find($id);
        $category->status = 1;
        $category->save();

        return redirect()->back()->with('message', '<div class="alert alert-success" role="alert"> Published successfully!</div>');
    }

    public function unpublish($id)
    {
        $category = Category::find($id);
        $category->status = 0;
        $category->save();

        return redirect()->back()->with('message', '<div class="alert alert-success" role="alert">Unublished successfully!</div>');
    }

}
