@extends('admin.master')

@section('pageTitle')
Products | Online shop
@endsection

@section('headerScriptArea2')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('/') }}admin-panel/plugins/datatables/dataTables.bootstrap.css">

@endsection

@section('body')

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      {{-- <h1>All categories</h1> --}}

      <div class="row">
        <div class="col-md-8">
          <h1>All products</h1>
        </div>
        <div class="col-md-4">
          <div align="right"><a href="{{ route('product.create') }}" class="btn btn-primary float-right page-header"><i class="fa fa-plus"></i> Add new product</a></div>
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
                  <th>Serial no.</th>
                  <th>Product name</th>
                  <th>Uploaded by</th>
                  <th>Price</th>
                  <th>Quantity</th>
                  <th>Brand</th>
                  <th>Image</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                       @php($i = 1)
                        @foreach($products as $product)

                          @if(Auth::user()->role == 1 || Auth::user()->role == 2)
                              <tr>
                                  <td>{{ $i++ }}</td>                               
                                  <td>{{ $product->product_name }}</td>
                                  <td>{{ $product->name }}</td>
                                  <td>{{ $product->product_price }}</td>
                                  <td>{{ $product->product_qty }}</td>
                                  <td>{{ $product->brand_name }}</td>
                                  <td><img src="{{ asset('/') }}uploads/product-images/{{$product->product_image}}" width="75px" height="75px"></td>
                                  <td>{{ $product->status == 1 ? 'Published' : 'Not published' }}</td>

                                  <td>
                                      @if($product->status == 1)
                                          <a href="{{route('unpublish-product', ['id' => $product->id])}}" class="btn btn-warning" title="Unpublish"><span><i class="fa fa-arrow-down"></i></span></a>
                                      @else
                                          <a href="{{route('publish-product', ['id' => $product->id])}}" class="btn btn-primary" title="Publish"><span><i class="fa fa-arrow-up"></i></span></a>
                                      @endif
                                      <a href="{{ route('product.show', ['id' => $product->id]) }}" class="btn btn-success"><span><i class="fa fa-edit"></i></span></a>
       

                                      <form action="{{ route('product.destroy', $product->id) }}" method="POST" style="display: inline-block;">
                                          @csrf
                                          <input type="hidden" name="_method" value="DELETE">
                                          <button type="submit" onclick="return confirm('Are you sure want to delete this?');" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                                      </form>
                                  </td>
                              </tr>
                           @elseif($product->user_id == Auth::user()->id)  
                              <tr>
                                  <td>{{ $i++ }}</td>                               
                                  <td>{{ $product->product_name }}</td>
                                  <td>{{ $product->name }}</td>
                                  <td>{{ $product->product_price }}</td>
                                  <td>{{ $product->product_qty }}</td>
                                  <td>{{ $product->brand_name }}</td>
                                  <td><img src="{{ asset('/') }}uploads/product-images/{{$product->product_image}}" width="75px" height="75px"></td>
                                  <td>{{ $product->status == 1 ? 'Published' : 'Not published' }}</td>

                                  <td>
                                      @if($product->status == 1)
                                          <a href="{{route('unpublish-product', ['id' => $product->id])}}" class="btn btn-warning" title="Unpublish"><span><i class="fa fa-arrow-down"></i></span></a>
                                      @else
                                          <a href="{{route('publish-product', ['id' => $product->id])}}" class="btn btn-primary" title="Publish"><span><i class="fa fa-arrow-up"></i></span></a>
                                      @endif
                                      <a href="{{ route('product.show', ['id' => $product->id]) }}" class="btn btn-success"><span><i class="fa fa-edit"></i></span></a>
       

                                      <form action="{{ route('product.destroy', $product->id) }}" method="POST" style="display: inline-block;">
                                          @csrf
                                          <input type="hidden" name="_method" value="DELETE">
                                          <button type="submit" onclick="return confirm('Are you sure want to delete this?');" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                                      </form>
                                  </td>
                              </tr>
                            @endif 
                                                     
                        @endforeach
                </tbody>
                <tfoot>
                <tr>
                  <th>Serial no.</th>
                  <th>Product name</th>
                  <th>Uploaded by</th>
                  <th>Price</th>
                  <th>Quantity</th>
                  <th>Brand</th>
                  <th>Image</th>
                  <th>Status</th>
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


<!-- page script -->
<script>
  $(function () {
    $("#example1").DataTable();

  });
</script>

@endsection