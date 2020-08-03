@extends('admin.master')

@section('pageTitle')
Manage orders | Online shop
@endsection

@section('headerScriptArea2')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('/') }}admin-panel/plugins/datatables/dataTables.bootstrap.css">

    <!--Custom CSS for image preview -->
    <link href="{{ asset('/') }}admin-panel/image-preview/image-preview.css" rel="stylesheet" type="text/css">

@endsection

@section('body')

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      {{-- <h1>All categories</h1> --}}

      <div class="row">
        <div class="col-md-8">
          <h1>All orders</h1>
        </div>
        <div class="col-md-4">

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
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>#</th> 
                  <th>Customer name</th>
                  <th>Order total</th>
                  <th>Order date</th> 
                  <th>Order status</th> 
                  <th>Payment type</th> 
                  <th>Payment status</th> 
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                     @php($i = 1)

                      @foreach($orders as $order)

                        <tr>
                          <td scope="row">{{$i++}}</td>
                          <td>{{ $order->first_name.' '.$order->last_name}}</td> 
                          <td>{{ $order->order_total }}</td> 
                          <td>{{ $order->created_at }}</td> 
                          <td>{{ $order->order_status }}</td> 
                          <td>{{ $order->payment_type }}</td> 
                          <td>{{ $order->payment_status }}</td> 

                          <td>
                            <a href="{{route('view-order-details', ['id' =>$order->id])}}" class="btn btn-info btn-xs" title="View order details"><span class="glyphicon glyphicon-zoom-in"></span></a>

                            <a href="{{route('view-order-invoice', ['id' =>$order->id])}}" class="btn btn-warning btn-xs" title="View order invoice"><span class="glyphicon glyphicon-zoom-out"></span></a>

                            <a href="{{route('download-order-invoice', ['id' =>$order->id])}}" class="btn btn-primary btn-xs" title="Download order invoice"><span class="glyphicon glyphicon-download"></span></a>

                            <a href="#" class="btn btn-success btn-xs" title="Edit order"><span class="glyphicon glyphicon-edit"></span></a>

                            <a href="#" class="btn btn-danger btn-xs" title="Delete order" onclick="return confirm('Are you sure want to delete this?');"><span class="glyphicon glyphicon-trash"></span></a>
                          </td> 

                        </tr> 

                      @endforeach
                </tbody>
                <tfoot>
                    <tr>
                      <th>#</th> 
                      <th>Customer name</th>
                      <th>Order total</th>
                      <th>Order date</th> 
                      <th>Order status</th> 
                      <th>Payment type</th> 
                      <th>Payment status</th> 
                      <th>Action</th>
                      </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

    </section>
    <!-- /.content -->
  </div>





@endsection

@section('footerScriptArea')

<!-- DataTables -->
  <script src="{{ asset('/') }}admin-panel/plugins/datatables/jquery.dataTables.min.js"></script>
  <script src="{{ asset('/') }}admin-panel/plugins/datatables/dataTables.bootstrap.min.js"></script>

    <!-- Image preview -->
    <script src="{{ asset('/') }}admin-panel/image-preview/image-preview.js"></script>

<!-- page script -->
<script>
  $(function () {
    $("#example1").DataTable();

  });
</script>

@endsection