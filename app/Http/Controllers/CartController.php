<?php

namespace App\Http\Controllers;

use App\StaticPage;
use App\Category;
use App\Brand;
use App\Setting;
use Cart;
use App\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function add(Request $request)
    {
    	$product = Product::find($request->id);

    	if($product->discount_price != 0.00)
    	{
    		$price = $product->discount_price;
    	}
    	else
    	{
    		$price = $product->product_price;
    	}

        if($request->qty)
        {
            $qty = $request->qty;
        }
        else
        {
            $qty = 1;
        }

    	Cart::add([
    		'id' 	=> $request->id,
    		'name' 	=> $product->product_name,
    		'price' => $price,
    		'qty' 	=> $qty,
    		'weight' 	=> 0,
    		'options' => [
    			'image' => $product->product_image
    		]
    	]);

    	return redirect('/cart/show');  	
    }

    public function show()
    {
    	$staticPages = StaticPage::where('status', 1)->get();
        $categories = Category::where('status', 1)->get();
    	$brands = Brand::where('status', 1)->get();
    	$settings = Setting::find(1);
 
     	$cartProducts = Cart::content();

     	// return $cartProducts;

    	return view('front-end.cart.show-cart', [
        	'staticPages' => $staticPages,
            'categories' => $categories,
    		'brands' => $brands,
    		'settings' => $settings,		
    		'cartProducts' => $cartProducts
    	]);   	
    }

    public function update(Request $request)
    {
     	Cart::update($request->rowId, $request->qty);
    	return redirect('/cart/show');   	
    }

    public function delete($id)
    {
      	Cart::remove($id);
    	return redirect('/cart/show/');  	
    }
}
