@extends('admin.master')

@section('pageTitle')
Order details | Online shop
@endsection

@section('headerScriptArea2')

    <!--Custom CSS for image preview -->
    <link href="{{ asset('/') }}admin-panel/image-preview/image-preview.css" rel="stylesheet" type="text/css">

@endsection

@section('body')

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      {{-- <h1>All categories</h1> --}}

      <div class="row">
        <div class="col-sm-8">
          <h1>Order details</h1>
        </div>
        <div class="col-sm-4">
          <h1><a class="btn btn-primary pull-right" href="{{route('view-order-invoice', ['id' =>$order->id])}}">View invoice</a></h1>
        </div>
      </div>
    </section>





    <!-- Main content -->
    <section class="content">

          <div class="box">
            <div class="box-header">
              {{-- <h3 class="box-title">All categories</h3> --}}

                @if(Session::has('message'))
                        <h3>{!! Session::get('message') !!}</h3>
                @endif


            </div>
            <!-- /.box-header -->
            <div class="box-body">










<div class="row">
  <div class="col-md-12">

    <div class="tables">
      <h3 class="text-center text-success">Order details</h3><br>
      <table class="table table-bordered">
        <tr>
          <th>Order no.</th>
          <td>{{$order->id}}</td>
        </tr>
        <tr>
          <th>Amount</th>
          <td>{{ $order->order_total}}</td>
        </tr>
        <tr>
          <th>Order status</th>
          <td>{{ $order->order_status}}</td>
        </tr>
        <tr>
          <th>Order date</th>
          <td>{{ $order->created_at}}</td>
        </tr>
        <tr>
          <th>Payment type</th>
          <td>{{ $payment->payment_type}}</td>
        </tr>
        <tr>
          <th>Payment status</th>
          <td>{{ $payment->payment_status}}</td>
        </tr>
      </table>
    </div>
    
  </div>
</div>


<div class="row">
  <div class="col-md-6">

    <div class="tables">
      <h3 class="text-center text-success">Customer information:</h3><br>
      <table class="table table-bordered">
        <tr>
          <th>Full name</th>
          <td>{{ $customer->first_name.' '.$customer->last_name}}</td>
        </tr>
        <tr>
          <th>Phone number</th>
          <td>{{ $customer->phone_number}}</td>
        </tr>
        <tr>
          <th>Email address</th>
          <td>{{ $customer->email_address}}</td>
        </tr>
        <tr>
          <th>Address</th>
          <td>{{ $customer->address}}</td>
        </tr>
      </table>
    </div>
    
  </div>
  <div class="col-md-6">
 <div class="tables">
      <h3 class="text-center text-success">Shipping information:</h3><br>
      <table class="table table-bordered">
        <tr>
          <th>Full name</th>
          <td>{{ $shipping->full_name}}</td>
        </tr>
        <tr>
          <th>Phone number</th>
          <td>{{ $shipping->phone_number}}</td>
        </tr>
        <tr>
          <th>Email address</th>
          <td>{{ $shipping->email_address}}</td>
        </tr>
        <tr>
          <th>Address</th>
          <td>{{ $shipping->address}}</td>
        </tr>
      </table>
    </div>   
  </div>
</div>





<div class="row">
  <div class="col-md-12">

    <div class="tables">
      <h3 class="text-center text-success">Product details:</h3><br>
      <table class="table table-bordered">
        <tr>
          <th>SL no.</th>
          <th>Product ID.</th>
          <th>Product name</th>
          <th>Image</th>
          <th>Product price</th>
          <th>Product quantity</th>
          <th>Total price</th>
        </tr>

          @php($i = 1)

      @foreach($orderDetails as $orderDetail )

        <tr>
          <td scope="row">{{$i++}}</td>
          <td>{{ $orderDetail->product_id}}</td>
          <td>{{ $orderDetail->product_name}}</td>
          <td><img src="{{ asset('/') }}uploads/product-images/{{ $orderDetail->product_image}}" width="50px" height="50px"></td>
          <td>{{ $orderDetail->product_price}}</td>
          <td>{{ $orderDetail->product_quantity}}</td>
          <td>Tk. {{ $orderDetail->product_quantity * $orderDetail->product_price}}</td>
        </tr>

      @endforeach

      </table>
    </div>
    
  </div>
</div>

















            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

    </section>
    <!-- /.content -->
  </div>





@endsection

@section('footerScriptArea')



    <!-- Image preview -->
    <script src="{{ asset('/') }}admin-panel/image-preview/image-preview.js"></script>

<!-- page script -->
<script>
  $(function () {
    $("#example1").DataTable();

  });
</script>

@endsection