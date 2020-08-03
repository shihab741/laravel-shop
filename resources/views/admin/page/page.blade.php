@extends('admin.master')

@section('pageTitle')
Pages | Online shop
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
          <h1>All pages</h1>
        </div>
        <div class="col-md-4">
          <div align="right"><a href="{{ route('page.create') }}" class="btn btn-primary float-right page-header"><i class="fa fa-plus"></i> Add new page</a></div>
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
                  <th>Heading</th>
                  <th>Slug</th>
                  <th>Image</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                       @php($i = 1)
                        @foreach($pages as $page)

                          <tr>
                              <td>{{ $i++ }}</td>                               
                              <td>{{ $page->url }}</td>
                              <td>{{ $page->heading }}</td>
                              <td><img src="{{ asset('/') }}uploads/page-images/{{$page->image}}" width="75px" height="75px"></td>                           
                              <td>{{ $page->status == 1 ? 'Published' : 'Not published' }}</td>

                              <td>
                                  @if($page->status == 1)
                                      <a href="{{route('unpublish-page', ['id' => $page->id])}}" class="btn btn-warning" title="Unpublish"><span><i class="fa fa-arrow-down"></i></span></a>
                                  @else
                                      <a href="{{route('publish-page', ['id' => $page->id])}}" class="btn btn-primary" title="Publish"><span><i class="fa fa-arrow-up"></i></span></a>
                                  @endif
                                  <a href="{{ route('page.show', ['id' => $page->id]) }}" class="btn btn-success"><span><i class="fa fa-edit"></i></span></a>
   

                                  <form action="{{ route('page.destroy', $page->id) }}" method="POST" style="display: inline-block;">
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
                  <th>Heading</th>
                  <th>Slug</th>
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