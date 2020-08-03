@extends('admin.master')

@section('pageTitle')
Users | Online shop
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
          <h1>All users</h1>
        </div>
        <div class="col-md-4">
          <div align="right"><a href="{{ route('user.create') }}" class="btn btn-primary float-right page-header"><i class="fa fa-plus"></i> Add new user</a></div>
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
                  <th>Sl No.</th>
                  <th>User Name</th>
                  <th>User Phone</th>
                  <th>User Email</th>
                  <th>User Address</th>
                  <th>User Image</th>
                  <th>User Role</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                       @php($i = 1)
                        @foreach($users as $user)
                            <tr>
                                <td>{{ $i++ }}</td>                               
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->phone }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->address }}</td>
                                <td><img src="{{ asset('/') }}uploads/user-images/{{$user->photo}}" width="75px" height="75px"></td>

                               @if($user->role==1)
                                  <td>Super Admin</td>
                              @elseif($user->role==2)
                                  <td>Admin</td>
                              @elseif($user->role==3)
                                  <td>Vendor</td>
                              @endif   

                                <td>{{ $user->status == 1 ? 'Active' : 'Inactive' }}</td>

                                <td>
                                    @if($user->status == 1)
                                        <a href="{{route('unpublish-user', ['id' => $user->id])}}" class="btn btn-warning" title="Deactivate"><span><i class="fa fa-arrow-down"></i></span></a>
                                    @else
                                        <a href="{{route('publish-user', ['id' => $user->id])}}" class="btn btn-primary" title="Activate"><span><i class="fa fa-arrow-up"></i></span></a>
                                    @endif
                                    <a href="{{ route('user.show', ['id' => $user->id]) }}" class="btn btn-success"><span><i class="fa fa-edit"></i></span></a>
     

                                    <form action="{{ route('user.destroy', $user->id) }}" method="POST" style="display: inline-block;">
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
                  <th>Sl No.</th>
                  <th>User Name</th>
                  <th>User Phone</th>
                  <th>User Email</th>
                  <th>User Address</th>
                  <th>User Image</th>
                  <th>User Role</th>
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