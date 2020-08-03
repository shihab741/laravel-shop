<?php

namespace App\Http\Controllers;

use DB;
use PDF;
use App\Order;
use App\Customer;
use App\Shipping;
use App\Payment;
use App\OrderDetail;
use App\Setting;
use App\Product;
use Illuminate\Http\Request;

class OrderController extends Controller
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
        //
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }

    public function manageOrderInfo()
    {
        $orders = DB::table('orders')
            ->join('customers', 'orders.customer_id', '=', 'customers.id')
            ->join('payments', 'orders.id', '=', 'payments.order_id')
            ->select('orders.*', 'customers.first_name', 'customers.last_name', 'payments.payment_type', 'payments.payment_status')
            ->get();

        return view('admin.order.manage-order', ['orders' => $orders]);
    }

    public function viewOrderDetails($id)
    {
        $order = Order::find($id);
        $customer = Customer::find($order->customer_id);
        $shipping = Shipping::find($order->shipping_id);
        $payment = Payment::where('order_id', $order->id)->first();

        // $orderDetails = OrderDetail::where('order_id', $order->id)->get();

        $orderDetails = DB::table('order_details')
            ->join('products', 'order_details.product_id', '=', 'products.id')
            ->select('order_details.*', 'products.product_image')
            ->where('order_id', $order->id)
            ->get();

        return view('admin.order.view-order',[
            'order' => $order,
            'customer' => $customer,
            'shipping' => $shipping,
            'payment' => $payment,
            'orderDetails' => $orderDetails
        ]);
    }

    public function viewOrderInvoice($id)
    {
        $settings = Setting::find(1);

        $order = Order::find($id);
        $customer = Customer::find($order->customer_id);
        $shipping = Shipping::find($order->shipping_id);
        $payment = Payment::where('order_id', $order->id)->first();

        $orderDetails = OrderDetail::where('order_id', $order->id)->get();

        return view('admin.order.view-order-invoice',[
            'settings' => $settings,
            'order' => $order,
            'customer' => $customer,
            'shipping' => $shipping,
            'payment' => $payment,
            'orderDetails' => $orderDetails
        ]);
    }

    public function downloadOrderInvoice($id)
    {
        $settings = Setting::find(1);

        $order = Order::find($id);
        $customer = Customer::find($order->customer_id);
        $shipping = Shipping::find($order->shipping_id);
        $payment = Payment::where('order_id', $order->id)->first();

        $orderDetails = OrderDetail::where('order_id', $order->id)->get();

        $pdf = PDF::loadView('admin.order.download-invoice',[
            'settings' => $settings,
            'order' => $order,
            'customer' => $customer,
            'shipping' => $shipping,
            'payment' => $payment,
            'orderDetails' => $orderDetails
        ]);
        return $pdf->stream('invoice.pdf');
        // return $pdf->download('invoice.pdf');

        // return view('admin.order.download-invoice');
    }
}
