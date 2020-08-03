  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="{{ asset('/') }}uploads/user-images/{{ Auth::user()->photo }}" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>{{ Auth::user()->name }}</p>
        </div>
      </div>

      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li class="header">Navigation</li>
        <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="{{ url('product') }}"><i class="fa fa-circle-o"></i> Products</a></li>

        @if(Auth::user()->role == 1 || Auth::user()->role == 2)
          <li><a href="{{ route('manage-orders') }}"><i class="fa fa-circle-o"></i> Manage orders</a></li>     
          <li><a href="{{ url('category') }}"><i class="fa fa-circle-o"></i> Categories</a></li>
          <li><a href="{{ url('brand') }}"><i class="fa fa-circle-o"></i> Brands</a></li>
          <li><a href="{{ url('page') }}"><i class="fa fa-circle-o"></i> Pages</a></li>
          <li><a href="{{ url('setting') }}"><i class="fa fa-gear"></i> Settings</a></li>
        @endif

        @if(Auth::user()->role == 1)
          <li><a href="{{ url('user') }}"><i class="nav-icon fa fa-user"></i> Users</a></li>
        @endif
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>