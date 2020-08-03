  <header class="main-header">
    <!-- Logo -->
    <a href="{{ route('dashboard') }}" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini">Shop</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg">Online shop</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="{{ asset('/') }}uploads/user-images/{{ Auth::user()->photo }}" class="user-image" alt="User Image">
              <span class="hidden-xs">{{ Auth::user()->name }}&nbsp; &nbsp;</span>
               <i class="glyphicon glyphicon-menu-down"></i>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="{{ asset('/') }}uploads/user-images/{{ Auth::user()->photo }}" class="img-circle" alt="User Image">

                <p>
                  {{ Auth::user()->name }} - 

                  @if(Auth::user()->role == 1)
                    Super Admin
                  @elseif(Auth::user()->role == 2)
                    Admin
                  @else
                    Vendor
                  @endif
                </p>
              </li>

              <!-- Menu Footer-->
              <li class="user-footer" style="background-color: #367fa9;">
                <div class="pull-left">
                  <a href="{{ route('user-profile') }}" class="btn btn-default btn-flat">Profile</a>

                </div>

                <div class="pull-right">
                  <a href="" class="btn btn-default btn-flat" 
                        onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();"
                    >Sign out</a>
                   
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>

                </div>
              </li>
            </ul>
          </li>

        </ul>
      </div>
    </nav>
  </header>