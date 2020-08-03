<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\StaticPage;
use App\Category;
use App\Brand;
use App\Setting;
use App\Product;
use DB;

class VueController extends Controller
{
    public function index()
    {
    	return view('public.master');
    }

    public function getCategories()
    {
         $categories = Category::where('status', 1)->select('id', 'cat_name')->orderBy('cat_name', 'asc')->get(); 

         return response()->json([
         	'categories' => $categories
         ]);  	
    }

    public function allProducts()
    {
    	$settings = Setting::find(1);

        $productsPerPage = $settings->product_per_page;

        // $products = Product::select('id', 'product_name', 'discount_price', 'product_price', 'product_image')->where('status', 1)->simplePaginate($productsPerPage);

        $products = Product::select('id', 'product_name', 'discount_price', 'product_price', 'product_image')->where('status', 1)->get();
        

        return response()->json([
         	'products' => $products
         ]); 
    }

    public function allProductsByCategory($id)
    {

        $products = DB::table('products')
                    ->join('product_category_relations', 'product_category_relations.product_id', '=', 'products.id')
                    ->join('categories', 'categories.id', '=', 'product_category_relations.cat_id')
                    ->select('products.id', 'products.product_name', 'products.product_price', 'products.discount_price', 'products.product_image')
                    ->where('products.status', 1)
                    ->where('categories.id', $id)
                    ->get();

        return response()->json([
            'productsByCategory' => $products
         ]); 
    }

    public function singleProductDetails($id)
    {
         $product = DB::table('products')
                                ->join('brands', 'brands.id', '=', 'products.brand_id')
                                ->select('products.*', 'brands.brand_name')
                                ->where('products.id', $id)
                                ->first();  
                                
        return response()->json([
            'productDetails' => $product
         ]);        
    }
}
