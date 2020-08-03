<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\StaticPage;
use App\Category;
use App\Brand;
use App\Setting;
use App\Product;
use DB;

class ShopController extends Controller
{
    public function index()
    {
    	$staticPages = StaticPage::where('status', 1)->get();
        $categories = Category::where('status', 1)->get();
    	$brands = Brand::where('status', 1)->get();
    	$settings = Setting::find(1);

        $productsPerPage = $settings->product_per_page;

        $products = Product::select('id', 'product_name', 'discount_price', 'product_price', 'product_image')->where('status', 1)->simplePaginate($productsPerPage);

    	return view('front-end.home.home',[
    		'staticPages' => $staticPages,
            'categories' => $categories,
    		'brands' => $brands,
    		'settings' => $settings,
            'products' => $products
    	]);
    }

    public function page($url)
    {
        $staticPages = StaticPage::where('status', 1)->get();
        $categories = Category::where('status', 1)->get();
        $brands = Brand::where('status', 1)->get();
        $settings = Setting::find(1);

        $singleStaticPage = StaticPage::where('url', $url)->first();

        if($singleStaticPage->status)
        {
            return view('front-end.page.page',[
                'staticPages' => $staticPages,
                'categories' => $categories,
                'brands' => $brands,
                'settings' => $settings,
                'singleStaticPage' => $singleStaticPage
            ]);  
        }
        else
        {
            return view('front-end.404.404',[
                'staticPages' => $staticPages,
                'categories' => $categories,
                'brands' => $brands,
                'settings' => $settings
            ]);              
        }   
    }

    public function brand($id)
    {
        $staticPages = StaticPage::where('status', 1)->get();
        $categories = Category::where('status', 1)->get();
        $brands = Brand::where('status', 1)->get();
        $settings = Setting::find(1);

        $productsPerPage = $settings->product_per_page;

        $products = Product::select('id', 'product_name', 'discount_price', 'product_price', 'product_image')->where('status', 1)->where('brand_id', $id)->simplePaginate($productsPerPage);

        $brandInfo = Brand::find($id);

        if($brandInfo->status)
        {
            return view('front-end.brand.brand',[
                'staticPages' => $staticPages,
                'categories' => $categories,
                'brands' => $brands,
                'settings' => $settings,
                'products' => $products,
                'brandInfo' => $brandInfo
            ]);
        }
        else
        {
             return view('front-end.404.404',[
                'staticPages' => $staticPages,
                'categories' => $categories,
                'brands' => $brands,
                'settings' => $settings
            ]);           
        }
    }

    public function category($id)
    {
        $staticPages = StaticPage::where('status', 1)->get();
        $categories = Category::where('status', 1)->get();
        $brands = Brand::where('status', 1)->get();
        $settings = Setting::find(1);

        $productsPerPage = $settings->product_per_page;

        // $products = Product::select('id', 'product_name', 'discount_price', 'product_price', 'product_image')->where('status', 1)->where('brand_id', $id)->simplePaginate($productsPerPage);


        $products = DB::table('products')
                    ->join('product_category_relations', 'product_category_relations.product_id', '=', 'products.id')
                    ->join('categories', 'categories.id', '=', 'product_category_relations.cat_id')
                    ->select('products.id', 'products.product_name', 'products.product_price', 'products.discount_price', 'products.product_image')
                    ->where('products.status', 1)
                    ->where('categories.id', $id)
                    ->simplePaginate($productsPerPage);

        $categoryInfo = Category::find($id);

        if($categoryInfo->status)
        {
            return view('front-end.category.category',[
                'staticPages' => $staticPages,
                'categories' => $categories,
                'brands' => $brands,
                'settings' => $settings,
                'products' => $products,
                'categoryInfo' => $categoryInfo
            ]);
        }
        else
        {
             return view('front-end.404.404',[
                'staticPages' => $staticPages,
                'categories' => $categories,
                'brands' => $brands,
                'settings' => $settings
            ]);           
        }
    }

    public function single($id)
    {

        $staticPages = StaticPage::where('status', 1)->get();
        $categories = Category::where('status', 1)->get();
        $brands = Brand::where('status', 1)->get();
        $settings = Setting::find(1);

        $categoriesForThisProduct = DB::table('products')
                    ->join('product_category_relations', 'product_category_relations.product_id', '=', 'products.id')
                    ->join('categories', 'categories.id', '=', 'product_category_relations.cat_id')
                    ->select('categories.id', 'categories.cat_name')
                    ->where('products.id', $id)
                    ->get();
        
        $product = DB::table('products')
                                ->join('brands', 'brands.id', '=', 'products.brand_id')
                                ->select('products.*', 'brands.brand_name')
                                ->where('products.id', $id)
                                ->first();  

        if($product->status)
        {
            return view('front-end.single.single',[
                'staticPages' => $staticPages,
                'categories' => $categories,
                'brands' => $brands,
                'settings' => $settings,
                'product' => $product,
                'categoriesForThisProduct' => $categoriesForThisProduct
            ]);
        }
        else
        {
             return view('front-end.404.404',[
                'staticPages' => $staticPages,
                'categories' => $categories,
                'brands' => $brands,
                'settings' => $settings
            ]);           
        }     
    }
}
