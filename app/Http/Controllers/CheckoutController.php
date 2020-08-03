<?php

namespace App\Http\Controllers;


use App\StaticPage;
use App\Category;
use App\Brand;
use App\Setting;
use App\Product;
use App\Customer;
use App\Shipping;
use App\Order;
use App\OrderDetail;
use App\Payment;
use Cart;
use Mail;
Use Session;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function index()
    {
        $staticPages = StaticPage::where('status', 1)->get();
        $categories = Category::where('status', 1)->get();
        $brands = Brand::where('status', 1)->get();
        $settings = Setting::find(1);

        return view('front-end.checkout.checkout',[
            'staticPages' => $staticPages,
            'categories' => $categories,
            'brands' => $brands,
            'settings' => $settings      
        ]);
    }

    public function customerSignUp(Request $request)
    {
     	
        $customer = new Customer;
    	$customer->first_name = $request->first_name;
    	$customer->last_name = $request->last_name;
    	$customer->email_address = $request->email_address;
    	$customer->password = bcrypt($request->password);
    	$customer->phone_number = $request->phone_number;
    	$customer->address = $request->address;
    	$customer->save();

    	$customerId = $customer->id;
    	Session::put('customerId', $customerId);
    	Session::put('customerName', $customer->first_name.' '.$customer->last_name);

        // To send email
        // $data = $customer->toArray(); 
        // Mail::send('front-end.mails.confirmation-mail', $data, function($message) use($data)
        // {
        //      $message->to($data['email_address']);
        //      $message->subject('Confirmation mail');
        // });

        if($request->is_checkout_page == 1)
        {
            return redirect('/checkout/shipping/'); 
        }
        else
        {
            return redirect('/'); 
        }


    		
    }

    public function customerLogout()
    {
        Session::forget('customerId');
        Session::forget('customerName');

        return redirect('/');
    }

    public function customerLoginCheck(Request $request)
    {
       $customer = Customer::where('email_address', $request->email_address)->first();

       if ($customer) 
       {
	       if(password_verify($request->password, $customer->password))
	       {
	        Session::put('customerId', $customer->id);
	        Session::put('customerName', $customer->first_name.' '.$customer->last_name);

               if($request->is_checkout_page == 1)
                {
                    return redirect('/checkout/shipping/'); 
                }
                else
                {
                    return redirect('/'); 
                }
	       }
	       else
	       {
	        return redirect('/')->with('message', '<div class="alert alert-danger" role="alert">Password did not match!</div>');
	       }       	
       }
       else
       {
       		return redirect('/')->with('message', '<div class="alert alert-danger" role="alert">This email address does not exist in database!</div>');
       }    	
    }


    public function shippingForm()
    {
        if(! Session::get('customerId'))
        {
            return redirect('/');
        }

        $staticPages = StaticPage::where('status', 1)->get();
        $categories = Category::where('status', 1)->get();
        $brands = Brand::where('status', 1)->get();
        $settings = Setting::find(1);   

        $customer = Customer::find(Session::get('customerId'));
        return view('front-end.checkout.shipping', [
            'staticPages' => $staticPages,
            'categories' => $categories,
            'brands' => $brands,
            'settings' => $settings,              
            'customer' => $customer
        ]);
    }

    public function saveShippingInfo(Request $request)
    {
        $shipping = new Shipping;
        $shipping->full_name = $request->full_name;
        $shipping->email_address = $request->email_address;
        $shipping->phone_number = $request->phone_number;
        $shipping->address = $request->address;
        $shipping->save();

        Session::put('shippingId', $shipping->id);

        return redirect('/checkout/payment/');
    }

    public function shippingFormEdit()
    {
         if(! Session::get('customerId'))
        {
            return redirect('/');
        }

        $staticPages = StaticPage::where('status', 1)->get();
        $categories = Category::where('status', 1)->get();
        $brands = Brand::where('status', 1)->get();
        $settings = Setting::find(1);   

        // $customer = Customer::find(Session::get('customerId'));
         $customer = Shipping::find(Session::get('shippingId'));
        return view('front-end.checkout.shipping-edit', [
            'staticPages' => $staticPages,
            'categories' => $categories,
            'brands' => $brands,
            'settings' => $settings,              
            'customer' => $customer
        ]);       
    }

    public function updateShippingInfo(Request $request)
    {
        $shipping = Shipping::find(Session::get('shippingId'));

        $shipping->full_name = $request->full_name;
        $shipping->email_address = $request->email_address;
        $shipping->phone_number = $request->phone_number;
        $shipping->address = $request->address;
        $shipping->save();

        return redirect('/checkout/payment/');
    }


    public function paymentForm()
    {

        $staticPages = StaticPage::where('status', 1)->get();
        $categories = Category::where('status', 1)->get();
        $brands = Brand::where('status', 1)->get();
        $settings = Setting::find(1);  

        // $customer = Customer::find(Session::get('customerId'));
        $customer = Shipping::find(Session::get('shippingId'));

        return view('front-end.checkout.payment',[
            'staticPages' => $staticPages,
            'categories' => $categories,
            'brands' => $brands,
            'settings' => $settings,
            'customer' => $customer
        ]);
    }

    public function newOrder(Request $request)
    {
        $paymentType = $request->payment_type;
        if($paymentType == 'cash')
        {
            $order = new Order();
            $order->customer_id = Session::get('customerId');
            $order->shipping_id = Session::get('shippingId');
            $order->order_total = Session::get('orderTotal');
            $order->save();

            $payment = new Payment();
            $payment->order_id = $order->id;
            $payment->payment_type = $paymentType;
            $payment->save();

            $cartProducts = Cart::content();
            foreach($cartProducts as $cartProduct){
                $orderDetail = new OrderDetail();
                $orderDetail->order_id = $order->id;
                $orderDetail->product_id = $cartProduct->id;
                $orderDetail->product_name = $cartProduct->name;
                $orderDetail->product_price = $cartProduct->price;
                $orderDetail->product_quantity = $cartProduct->qty;
                $orderDetail->save();
            }

            Cart::destroy();

            return redirect('/complete/order');
        }
        else if($paymentType == 'stripe')
        {
            $order = new Order();
            $order->customer_id = Session::get('customerId');
            $order->shipping_id = Session::get('shippingId');
            $order->order_total = Session::get('orderTotal');
            $order->save();

            $payment = new Payment();
            $payment->order_id = $order->id;
            $payment->payment_type = $paymentType;
            $payment->save();

            $cartProducts = Cart::content();
            foreach($cartProducts as $cartProduct){
                $orderDetail = new OrderDetail();
                $orderDetail->order_id = $order->id;
                $orderDetail->product_id = $cartProduct->id;
                $orderDetail->product_name = $cartProduct->name;
                $orderDetail->product_price = $cartProduct->price;
                $orderDetail->product_quantity = $cartProduct->qty;
                $orderDetail->save();
            }

            Cart::destroy();

            return redirect('/complete/order');
        }

        else
        {

        }
    }

    public function completeOrder()
    {
        if(! Session::get('customerId') )
        {
            return redirect('/');
        }

        if(! session::get('shippingId'))
        {
            return redirect('/');            
        }

        Session::forget('shippingId');

        $staticPages = StaticPage::where('status', 1)->get();
        $categories = Category::where('status', 1)->get();
        $brands = Brand::where('status', 1)->get();
        $settings = Setting::find(1);  

        return view('front-end.checkout.order-completed',[
            'staticPages' => $staticPages,
            'categories' => $categories,
            'brands' => $brands,
            'settings' => $settings
        ]);
    }

    public function ajaxEmailCheck()
    {
        $a = $_GET['email'];

        $customer = Customer::where('email_address', $a)->first();

        if($customer)
        {
            echo "Already exists!";
        }
        else
        {
            echo 'Available!';
        }
    }
}
