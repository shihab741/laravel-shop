@extends('admin.master')

@section('pageTitle')
Profile | Online shop
@endsection

@section('headerScriptArea')

@endsection

@section('body')

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Profile</h1>
    </section>

    <!-- Main content -->
    <section class="content">

          <!-- Profile Image -->
          <div class="box box-primary">
            <div class="box-body box-profile">
              <img class="profile-user-img img-responsive img-circle" src="{{ asset('/') }}uploads/user-images/{{ Auth::user()->photo }}" alt="User profile picture">

              <h3 class="profile-username text-center">{{ Auth::user()->name }}</h3> 

              <p class="text-muted text-center">
                @if(Auth::user()->role == 1)
                  Super admin
                @elseif(Auth::user()->role == 2)
                  Admin
                @else
                  Vendor
                @endif
              </p>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

          <!-- About Me Box -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">About</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <strong><i class="glyphicon glyphicon-phone-alt"></i> Telephone</strong>
                <p class="text-muted">
                  {{ $user->phone }}
                </p>
                <hr>

                <strong><i class="glyphicon glyphicon-envelope"></i> Email</strong>
                <p class="text-muted">
                  {{ $user->email }}
                </p>
                <hr>

                <strong><i class="fa fa-map-marker margin-r-5"></i> Address</strong>
                <p class="text-muted">{{ $user->address }}</p>
                <hr>

            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

    </section>
    <!-- /.content -->
  </div>
@endsection

@section('footerScriptArea')

@endsection