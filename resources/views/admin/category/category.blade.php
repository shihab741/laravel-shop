@extends('admin.master')

@section('pageTitle')
Categories | Online shop
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
          <h1>All categories</h1>
        </div>
        <div class="col-md-4">
          <div align="right"><button class="btn btn-primary float-right page-header" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-plus"></i> Add new category</button></div>
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
                  <th>Category name and description</th>
                  <th>Image</th>
                  <th>Publication status</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                       @php($i = 1)
                        @foreach($categories as $category)
                            <tr>
                                <td>{{ $i++ }}</td>                               
                                <td><strong>{{ $category->cat_name }}</strong><br> {{ $category->cat_desc}}</td>
                                <td><img src="{{ asset('/') }}uploads/category-images/{{$category->cat_image}}" width="75px" height="75px"></td>
                                <td>{{ $category->status == 1 ? 'Published' : 'Not published' }}</td>

                                <td>
                                    @if($category->status == 1)
                                        <a href="{{route('unpublish-category', ['id' => $category->id])}}" class="btn btn-warning" title="Unpublish"><span><i class="fa fa-arrow-down"></i></span></a>
                                    @else
                                        <a href="{{route('publish-category', ['id' => $category->id])}}" class="btn btn-primary" title="Publish"><span><i class="fa fa-arrow-up"></i></span></a>
                                    @endif
                                    <a href="{{ route('category.show', ['id' => $category->id]) }}" class="btn btn-success"><span><i class="fa fa-edit"></i></span></a>
     

                                    <form action="{{ route('category.destroy', $category->id) }}" method="POST" style="display: inline-block;">
                                        @csrf
                                        <input type="hidden" name="_method" value="DELETE">
                                        <button type="submit" onclick="return confirm('Are you sure want to delete this?');" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>

                        @endforeach
                </tbody>
                <tfoot>
                <tr>
                  <th>Serial no.</th>
                  <th>Category name and description</th>
                  <th>Image</th>
                  <th>Publication status</th>
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


@include('admin.category.add-modal')


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