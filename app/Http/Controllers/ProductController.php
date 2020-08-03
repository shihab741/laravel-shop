<?php

namespace App\Http\Controllers;

use App\Product;
use App\Category;
use App\Brand;
use App\ProductCategoryRelation;
use Image;
use DB;
use Auth;
use Illuminate\Http\Request;

class ProductController extends Controller
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
        //  $categories = Category::where('status', 1)->get();
        // $brands = Brand::where('status', 1)->get();

        // $products = DB::table('products')
        //             ->join('brands', 'brands.id', '=', 'products.brand_id')
        //             ->select('products.*', 'brands.brand_name')
        //             ->get();

        // return view('admin.product.product', [
        //     'categories' => $categories,
        //     'brands'    => $brands,
        //     'products' => $products
        // ]);  

        // $products = Product::select('id', 'product_name', 'product_price', 'product_qty', 'product_image', 'status')
        //                      ->get();


        $products = DB::table('products')
                    ->join('brands', 'brands.id', '=', 'products.brand_id')
                    ->join('users', 'users.id', '=', 'products.user_id')
                    ->select('products.id', 'products.product_name', 'products.product_price', 'products.product_qty', 'products.product_image', 'products.status', 'products.user_id','brands.brand_name', 'users.name')
                    ->get();
                               
        return view('admin.product.product', ['products' => $products]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::where('status', 1)->get();
        $brands = Brand::where('status', 1)->get();

        return view('admin.product.add',[
            'categories' => $categories,
            'brands'    => $brands
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Uploading featured image
        $image = $request->file('product_image');
        $imageName = $image->getClientOriginalName();
        $directory = 'uploads/product-images/';
        $imageUrl = $directory.$imageName;

        while(file_exists($imageUrl))
        {
            $imageNameWithoutExtension = basename($imageName, '.'.$image->getClientOriginalExtension());
            $imageName = $imageNameWithoutExtension.'-copy'.'.'.$image->getClientOriginalExtension();
            $imageUrl = $directory.$imageName;
        }

        Image::make($image)->resize(600,600)->save($imageUrl);

        //Uploading multiple image
        foreach($request->file('multiple_image') as $multipleImage)
        {
            $multipleImageName = $multipleImage->getClientOriginalName();
            $directory = 'uploads/product-images/';
            $multipleImageUrl = $directory.$multipleImageName;

            while(file_exists($multipleImageUrl))
            {
                $imageNameWithoutExtension = basename($multipleImageName, '.'.$multipleImage->getClientOriginalExtension());
                $multipleImageName = $imageNameWithoutExtension.'-copy'.'.'.$multipleImage->getClientOriginalExtension();
                $multipleImageUrl = $directory.$multipleImageName;
            }

            Image::make($multipleImage)->resize(600,600)->save($multipleImageUrl);

            $multipleImageData[] =  $multipleImageName;          
        }

        $product = new Product();
        $product->product_name = $request->product_name;
        $product->brand_id = $request->brand_id;
        $product->short_desc = $request->short_desc;
        $product->long_desc = $request->long_desc;
        $product->discount_price = $request->discount_price;
        $product->product_price = $request->product_price;
        $product->product_qty = $request->product_qty;
        $product->product_size = $request->product_size;
        $product->product_image = $imageName;
        $product->multiple_image = json_encode($multipleImageData);
        $product->status = $request->status;
        $product->user_id = Auth::user()->id;
        $product->save();

        $productID = $product->id;

        foreach($request->cat_id as $cat_id)
        {
            $productCategoryRelation = new ProductCategoryRelation();
            $productCategoryRelation->cat_id = $cat_id;           
            $productCategoryRelation->product_id = $productID;   
            $productCategoryRelation->save();        
        }

        return redirect()->back()->with('message', '<div class="alert alert-success" role="alert">Product added successfully!</div>'); 

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::find($id);

        if(Auth::user()->role == 1 || Auth::user()->role == 2)
        {
            $categories = Category::where('status', 1)->get();
            $brands = Brand::where('status', 1)->get();
            $product = Product::find($id);
            $selectedCategories = ProductCategoryRelation:: where('product_id', $id)->select('cat_id')->get();

            return view('admin.product.edit',[
                'categories' => $categories,
                'brands'    => $brands,
                'product' => $product,
                'selectedCategories' => $selectedCategories
            ]); 
        }
        elseif($product->user_id == Auth::user()->id)
        {
            $categories = Category::where('status', 1)->get();
            $brands = Brand::where('status', 1)->get();
            $product = Product::find($id);
            $selectedCategories = ProductCategoryRelation:: where('product_id', $id)->select('cat_id')->get();

            return view('admin.product.edit',[
                'categories' => $categories,
                'brands'    => $brands,
                'product' => $product,
                'selectedCategories' => $selectedCategories
            ]); 
        }
        else
        {
             return redirect('dashboard')->with('message', '<div class="alert alert-danger" role="alert">You dont have permission for this action!</div>');           
        }      
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
         $product  = Product::find($request->id);

         if(Auth::user()->role == 1 || Auth::user()->role == 2)
        {
            $this->edit_format($request, $product);

            return redirect('product')->with('message', '<div class="alert alert-success" role="alert">Product updated successfully!</div>'); 
        }
        elseif($product->user_id == Auth::user()->id)
        {
            $this->edit_format($request, $product);

            return redirect('product')->with('message', '<div class="alert alert-success" role="alert">Product updated successfully!</div>'); 
        }
        else
        {
             return redirect('dashboard')->with('message', '<div class="alert alert-danger" role="alert">You dont have permission for this action!</div>');           
        }      
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);

        if(Auth::user()->role == 1 || Auth::user()->role == 2)
        {
            if($product->product_image != null && $product->multiple_image != null)
                {
                    unlink('uploads/product-images/'.$product->product_image);

                    foreach(json_decode($product->multiple_image) as $multipleImage)
                    {
                        unlink('uploads/product-images/'.$multipleImage);

                    }

                    $product->delete();
                }

                elseif($product->product_image != null && $product->multiple_image == null)
                {
                    unlink('uploads/product-images/'.$product->product_image);
                    $product->delete();            
                }

                elseif($product->product_image == null && $product->multiple_image != null)
                {
                    foreach(json_decode($product->multiple_image) as $multipleImage)
                    {
                        unlink('uploads/product-images/'.$multipleImage);

                    }

                    $product->delete();            
                }

                else
                {
                    $product->delete();
                }

                ProductCategoryRelation::where('product_id', $id)->delete();

               return redirect()->back()->with('message', '<div class="alert alert-success" role="alert">Product deleted successfully!</div>'); 
        }
        elseif($product->user_id == Auth::user()->id)
        {
            if($product->product_image != null && $product->multiple_image != null)
            {
                unlink('uploads/product-images/'.$product->product_image);

                foreach(json_decode($product->multiple_image) as $multipleImage)
                {
                    unlink('uploads/product-images/'.$multipleImage);

                }

                $product->delete();
            }

            elseif($product->product_image != null && $product->multiple_image == null)
            {
                unlink('uploads/product-images/'.$product->product_image);
                $product->delete();            
            }

            elseif($product->product_image == null && $product->multiple_image != null)
            {
                foreach(json_decode($product->multiple_image) as $multipleImage)
                {
                    unlink('uploads/product-images/'.$multipleImage);

                }

                $product->delete();            
            }

            else
            {
                $product->delete();
            }

            ProductCategoryRelation::where('product_id', $id)->delete();

           return redirect()->back()->with('message', '<div class="alert alert-success" role="alert">Product deleted successfully!</div>'); 
        }
        else
        {
             return redirect('dashboard')->with('message', '<div class="alert alert-danger" role="alert">You dont have permission for this action!</div>');           
        }
      
    }

    public function publish($id)
    {
        $product = Product::find($id);
  
        if(Auth::user()->role == 1 || Auth::user()->role == 2)
        {
            $product->status = 1;
            $product->save();

            return redirect()->back()->with('message', '<div class="alert alert-success" role="alert"> Published successfully!</div>');
        }
        elseif($product->user_id == Auth::user()->id)
        {
            $product->status = 1;
            $product->save();

            return redirect()->back()->with('message', '<div class="alert alert-success" role="alert"> Published successfully!</div>');
        }
        else
        {
               return redirect('dashboard')->with('message', '<div class="alert alert-danger" role="alert">You dont have permission for this action!</div>');            
        }

    }

    public function unpublish($id)
    {
        $product = Product::find($id);

        if(Auth::user()->role == 1 || Auth::user()->role == 2)
        {
            $product->status = 0;
            $product->save();

            return redirect()->back()->with('message', '<div class="alert alert-success" role="alert">Unublished successfully!</div>');
        }
        elseif($product->user_id == Auth::user()->id)
        {
            $product->status = 0;
            $product->save();

            return redirect()->back()->with('message', '<div class="alert alert-success" role="alert">Unublished successfully!</div>');
        }
        else
        {
             return redirect('dashboard')->with('message', '<div class="alert alert-danger" role="alert">You dont have permission for this action!</div>');           
        }

    }

    public function edit_format($request, $product)
    {
        $image = $request->file('product_image');
        $multipleImageArray = $request->file('multiple_image');

         if($image != null && $multipleImageArray != null)
        {
            
            /**
             *
             * Deleting previous files and relations
             *
             */
            
            unlink('uploads/product-images/'.$product->product_image);

            foreach(json_decode($product->multiple_image) as $multipleImage)
            {
                unlink('uploads/product-images/'.$multipleImage);

            }

            ProductCategoryRelation::where('product_id', $request->id)->delete();

            /**
             *
             * Uploading and updating process starts
             *
             */

                $imageName = $image->getClientOriginalName();
                $directory = 'uploads/product-images/';
                $imageUrl = $directory.$imageName;

                while(file_exists($imageUrl))
                {
                    $imageNameWithoutExtension = basename($imageName, '.'.$image->getClientOriginalExtension());
                    $imageName = $imageNameWithoutExtension.'-copy'.'.'.$image->getClientOriginalExtension();
                    $imageUrl = $directory.$imageName;
                }

                Image::make($image)->resize(600,600)->save($imageUrl);

                //Uploading multiple image
                foreach($request->file('multiple_image') as $multipleImage)
                {
                    $multipleImageName = $multipleImage->getClientOriginalName();
                    $directory = 'uploads/product-images/';
                    $multipleImageUrl = $directory.$multipleImageName;

                    while(file_exists($multipleImageUrl))
                    {
                        $imageNameWithoutExtension = basename($multipleImageName, '.'.$multipleImage->getClientOriginalExtension());
                        $multipleImageName = $imageNameWithoutExtension.'-copy'.'.'.$multipleImage->getClientOriginalExtension();
                        $multipleImageUrl = $directory.$multipleImageName;
                    }

                    Image::make($multipleImage)->resize(600,600)->save($multipleImageUrl);

                    $multipleImageData[] =  $multipleImageName;          
                }

                $product->product_name = $request->product_name;
                $product->brand_id = $request->brand_id;
                $product->short_desc = $request->short_desc;
                $product->long_desc = $request->long_desc;
                $product->discount_price = $request->discount_price;
                $product->product_price = $request->product_price;
                $product->product_qty = $request->product_qty;
                $product->product_size = $request->product_size;
                $product->product_image = $imageName;
                $product->multiple_image = json_encode($multipleImageData);
                $product->status = $request->status;
                $product->save();

                $productID = $request->id;

                foreach($request->cat_id as $cat_id)
                {
                    $productCategoryRelation = new ProductCategoryRelation();
                    $productCategoryRelation->cat_id = $cat_id;           
                    $productCategoryRelation->product_id = $productID;   
                    $productCategoryRelation->save();        
                }

        }

        elseif($image != null && $multipleImageArray == null)
        {
            /**
             *
             * Deleting previous files and relations
             *
             */
            
            unlink('uploads/product-images/'.$product->product_image);


            ProductCategoryRelation::where('product_id', $request->id)->delete();

            /**
             *
             * Uploading and updating process starts
             *
             */

                $imageName = $image->getClientOriginalName();
                $directory = 'uploads/product-images/';
                $imageUrl = $directory.$imageName;

                while(file_exists($imageUrl))
                {
                    $imageNameWithoutExtension = basename($imageName, '.'.$image->getClientOriginalExtension());
                    $imageName = $imageNameWithoutExtension.'-copy'.'.'.$image->getClientOriginalExtension();
                    $imageUrl = $directory.$imageName;
                }

                Image::make($image)->resize(600,600)->save($imageUrl);


                $product->product_name = $request->product_name;
                $product->brand_id = $request->brand_id;
                $product->short_desc = $request->short_desc;
                $product->long_desc = $request->long_desc;
                $product->discount_price = $request->discount_price;
                $product->product_price = $request->product_price;
                $product->product_qty = $request->product_qty;
                $product->product_size = $request->product_size;
                $product->product_image = $imageName;
                $product->status = $request->status;
                $product->save();

                $productID = $request->id;

                foreach($request->cat_id as $cat_id)
                {
                    $productCategoryRelation = new ProductCategoryRelation();
                    $productCategoryRelation->cat_id = $cat_id;           
                    $productCategoryRelation->product_id = $productID;   
                    $productCategoryRelation->save();        
                }           
        }

        elseif($image == null && $multipleImageArray != null)
        {
            /**
             *
             * Deleting previous files and relations
             *
             */
            

            foreach(json_decode($product->multiple_image) as $multipleImage)
            {
                unlink('uploads/product-images/'.$multipleImage);

            }

            ProductCategoryRelation::where('product_id', $request->id)->delete();

            /**
             *
             * Uploading and updating process starts
             *
             */

                //Uploading multiple image
                foreach($request->file('multiple_image') as $multipleImage)
                {
                    $multipleImageName = $multipleImage->getClientOriginalName();
                    $directory = 'uploads/product-images/';
                    $multipleImageUrl = $directory.$multipleImageName;

                    while(file_exists($multipleImageUrl))
                    {
                        $imageNameWithoutExtension = basename($multipleImageName, '.'.$multipleImage->getClientOriginalExtension());
                        $multipleImageName = $imageNameWithoutExtension.'-copy'.'.'.$multipleImage->getClientOriginalExtension();
                        $multipleImageUrl = $directory.$multipleImageName;
                    }

                    Image::make($multipleImage)->resize(600,600)->save($multipleImageUrl);

                    $multipleImageData[] =  $multipleImageName;          
                }

                $product->product_name = $request->product_name;
                $product->brand_id = $request->brand_id;
                $product->short_desc = $request->short_desc;
                $product->long_desc = $request->long_desc;
                $product->discount_price = $request->discount_price;
                $product->product_price = $request->product_price;
                $product->product_qty = $request->product_qty;
                $product->product_size = $request->product_size;
                $product->multiple_image = json_encode($multipleImageData);
                $product->status = $request->status;
                $product->save();

                $productID = $request->id;

                foreach($request->cat_id as $cat_id)
                {
                    $productCategoryRelation = new ProductCategoryRelation();
                    $productCategoryRelation->cat_id = $cat_id;           
                    $productCategoryRelation->product_id = $productID;   
                    $productCategoryRelation->save();        
                }            
        }

        else
        {
            /**
             *
             * Deleting previous files and relations
             *
             */
            

            ProductCategoryRelation::where('product_id', $request->id)->delete();

            /**
             *
             * Uploading and updating process starts
             *
             */

                $product->product_name = $request->product_name;
                $product->brand_id = $request->brand_id;
                $product->short_desc = $request->short_desc;
                $product->long_desc = $request->long_desc;
                $product->discount_price = $request->discount_price;
                $product->product_price = $request->product_price;
                $product->product_qty = $request->product_qty;
                $product->product_size = $request->product_size;
                $product->status = $request->status;
                $product->save();

                $productID = $request->id;

                foreach($request->cat_id as $cat_id)
                {
                    $productCategoryRelation = new ProductCategoryRelation();
                    $productCategoryRelation->cat_id = $cat_id;           
                    $productCategoryRelation->product_id = $productID;   
                    $productCategoryRelation->save();        
                }
        }
         
    }

}
