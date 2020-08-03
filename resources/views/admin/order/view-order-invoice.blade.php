@extends('admin.master')

@section('pageTitle')
Invoice | Online shop
@endsection

@section('headerScriptArea2')

    <!--Custom CSS for image preview -->
    <link href="{{ asset('/') }}admin-panel/image-preview/image-preview.css" rel="stylesheet" type="text/css">

@endsection

@section('body')

  <div class="content-wrapper">



    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Invoice
        <small>#00{{$order->id}}</small>
      </h1>
    </section>



    <!-- Main content -->
    <section class="invoice">
      <!-- title row -->
      <div class="row">
        <div class="col-xs-12">
          <h2 class="page-header">
            <i class="fa fa-globe"></i> {{$settings->site_name}}
            <small class="pull-right">Date: {{ $order->created_at}}</small>
          </h2>
        </div>
        <!-- /.col -->
      </div>
      <!-- info row -->
      <div class="row invoice-info">
        <div class="col-sm-3 invoice-col">
          From
          <address>
            <strong>{{$settings->site_name}}</strong><br>
            {{$settings->address}}<br>    
            Phone: {{$settings->phone}}<br>
            Email: {{$settings->email}}
          </address>
        </div>
        <!-- /.col -->
        <div class="col-sm-3 invoice-col">
          Customer information
          <address>
            <strong>{{ $customer->first_name.' '.$customer->last_name}}</strong><br>
            {{ $customer->address}}<br>
            Phone: {{ $customer->phone_number}}<br>
            Email: {{ $customer->email_address}}
          </address>
        </div>
        <!-- /.col -->
        <div class="col-sm-3 invoice-col">
          Shipping address
          <address>
            <strong>{{ $shipping->full_name}}</strong><br>
            {{ $shipping->address}}<br>
            Phone: {{ $shipping->phone_number}}<br>
            Email: {{ $shipping->email_address}}
          </address>
        </div>
        <!-- /.col -->
        <div class="col-sm-3 invoice-col">
          <b>Invoice #00{{$order->id}}</b><br>
          <br>
          <b>Payment status:</b> {{ $payment->payment_status}}<br>
          <b>Delivery status:</b> {{ $order->order_status}}<br>
          <b>Chosen payment method:</b> {{ $payment->payment_type}}
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <!-- Table row -->
      <div class="row">
        <div class="col-xs-12 table-responsive">
          <table class="table table-striped">
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
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <div class="row">
        <!-- accepted payments column -->
        <div class="col-xs-6">
          <p class="lead">Payment Methods:</p>
          <img src="{{ asset('/') }}admin-panel/dist/img/credit/visa.png" alt="Visa">
          <img src="{{ asset('/') }}admin-panel/dist/img/credit/mastercard.png" alt="Mastercard">
          <img src="{{ asset('/') }}admin-panel/dist/img/credit/american-express.png" alt="American Express">
          <img src="{{ asset('/') }}admin-panel/dist/img/credit/paypal2.png" alt="Paypal">

        </div>
        <!-- /.col -->
        <div class="col-xs-6">
          <p class="lead">Amount Due </p>

          <div class="table-responsive">
            <table class="table">
              <tr>
                <th style="width:50%">Total:</th>
                <td>Tk. {{ $order->order_total}}</td>
              </tr>
{{--               <tr>
                <th>Tax (9.3%)</th>
                <td>$10.34</td>
              </tr>
              <tr>
                <th>Shipping:</th>
                <td>$5.80</td>
              </tr>
              <tr>
                <th>Total:</th>
                <td>$265.24</td>
              </tr> --}}
            </table>
          </div>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <!-- this row will not appear when printing -->
      <div class="row no-print">
        <div class="col-xs-12">

        <a class="btn btn-primary pull-right" style="margin-right: 5px;" href="{{route('download-order-invoice', ['id' =>$order->id])}}" target="_blank"><i class="fa fa-download"></i> Generate PDF</a>

        </div>
      </div>
    </section>
    <!-- /.content -->
    <div class="clearfix"></div>



   

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