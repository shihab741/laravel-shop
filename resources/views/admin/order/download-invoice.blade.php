<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>PDF invoice | Online shop</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
    <link rel="stylesheet" href="{{ asset('/') }}admin-panel/bootstrap/css/bootstrap.min.css">
</head>
<body>
<div class="wrapper">
  <!-- Main content -->
  <section class="invoice">
    <!-- title row -->
    <div class="row">
      <div class="col-xs-12">
        <h2 class="page-header">
          {{$settings->site_name}}
          <small class="pull-right" style="font-size: 8.5pt !important">Date: {{ $order->created_at}}</small>
        </h2>
      </div>
      <!-- /.col -->
    </div>
    <!-- info row -->

<div class="table-responsive" style="font-size: 8.5pt !important;">
    <table class="table table-striped">
        <tr>
            <td>
              From
              <address>
                <strong>{{$settings->site_name}}</strong><br>
                {{$settings->address}}<br>    
                Phone: {{$settings->phone}}<br>
                Email: {{$settings->email}}
              </address>
            </td>   
            <td>
              Customer information
              <address>
                <strong>{{ $customer->first_name.' '.$customer->last_name}}</strong><br>
                {{ $customer->address}}<br>
                Phone: {{ $customer->phone_number}}<br>
                Email: {{ $customer->email_address}}
              </address>
            </td>
            <td>
              Shipping address
              <address>
                <strong>{{ $shipping->full_name}}</strong><br>
                {{ $shipping->address}}<br>
                Phone: {{ $shipping->phone_number}}<br>
                Email: {{ $shipping->email_address}}
              </address>
            </td>  
            <td>
              <b>Invoice #00{{$order->id}}</b><br>
              <br>
              <b>Payment status:</b> {{ $payment->payment_status}}<br>
              <b>Delivery status:</b> {{ $order->order_status}}<br>
              <b>Chosen payment method:</b> {{ $payment->payment_type}}
            </td>   
        </tr>
    </table>
</div>

    <!-- Table row -->
    <div class="row">
        <div class="col-xs-12 table-responsive">
          <table class="table table-striped" style="font-size: 8.5pt !important">
            <thead>
            <tr>
              <th>SL no.</th>
              <th>Product ID</th>
              <th>Product name</th>
              <th>Price</th>
              <th>Quantity</th>
              <th>Sub total</th>
            </tr>
            </thead>
            <tbody>
                @php($i = 1)

                @foreach($orderDetails as $orderDetail )

                  <tr>
                    <td scope="row">{{$i++}}</td>
                    <td>00{{ $orderDetail->product_id}}</td>
                    <td>{{ $orderDetail->product_name}}</td>
                    <td>{{ $orderDetail->product_price}}</td>
                    <td>{{ $orderDetail->product_quantity}}</td>
                    <td>Tk. {{ $orderDetail->product_quantity * $orderDetail->product_price}}</td>
                  </tr>

                @endforeach
            </tbody>
          </table>
        </div>
    </div>
    <!-- /.row -->

    <div class="row">
      <!-- accepted payments column -->
      <div class="col-xs-6">

      </div>
      <!-- /.col -->
      <div class="col-xs-6">
        <p class="lead">Amount Due</p>

          <div class="table-responsive">
            <table class="table">
              <tr>
                <th style="width:50%">Total:</th>
                <td>Tk. {{ $order->order_total}}</td>
              </tr>
            </table>
          </div>
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </section>
  <!-- /.content -->
</div>
<!-- ./wrapper -->
</body>
</html>
