<!DOCTYPE html>

<html lang="en">
<head>
  <meta charset="utf-8">
  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>Anyi App| Starter</title>


<link rel="stylesheet" type="text/css" href="{{asset('css/app.css')}}">
{{-- <!-- <link rel="stylesheet" type="text/css" href="/css/app.css"> -->
  <!-- Font Awesome Icons -->
  <!-- <link rel="stylesheet" href="plugins/font-awesome/css/font-awesome.min.css"> -->
  <!-- Theme style -->
  <!-- <link rel="stylesheet" href="dist/css/adminlte.min.css"> -->
  <!-- Google Font: Source Sans Pro -->
  <!-- <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet"> --> --}}

</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper" id="app">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand bg-white navbar-light border-bottom">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fa fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="index3.html" class="nav-link">Home</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Contact</a>
      </li>
    </ul>

    <!-- SEARCH FORM -->
    <div class="form-inline ml-3">
      <div class="input-group input-group-sm">
        <input class="form-control form-control-navbar" type="search" @keyup="searchIt" v-model="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-navbar" @click="searchIt" >
            <i class="fa fa-search"></i>
          </button>
        </div>
      </div>
    </div>

  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="{{asset('img/computer.png')}}" alt="Anyi Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">Anyis App</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{asset('img/teacher.png')}}" class="img-circle elevation-2" alt="Boss Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{Auth::user()->name}}</a>
          <a href="#" class="d-block">{{Auth::user()->type}}</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

          <li class="nav-item">
            <router-link to="/dasboard" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt blue"></i>
              <p>
                Dashboard
              </p>
            </router-link>
          </li>


          <li class="nav-item has-treeview ">
            <a href="#" class="nav-link ">
              <i class="nav-icon fas fa-cog green"></i>
              <p>
                Management
                <i class="right fa fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <router-link to="/users" class="nav-link ">
                  <i class="fas fa-users nav-icon orange"></i>
                  <p>User</p>
                </router-link>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>Inactive Page</p>
                </a>
              </li>
            </ul>
          </li>
          {{-- <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fa fa-th"></i>
              <p>
                Simple Link
                <span class="right badge badge-danger">New</span>
              </p>
            </a>
          </li> --}}

          <li class="nav-item">
            <router-link to="/profile" class="nav-link">
              <i class="nav-icon fas fa-user orange"></i>
              <p>
                Profiles
              </p>
            </router-link>
          </li>

          @can('isAdmin')
          <li class="nav-item">
            <router-link to="/developer" class="nav-link">
              <i class="nav-icon fas fa-cogs orange"></i>
              <p>
                Developer(passport)
              </p>
            </router-link>
          </li>
          @endcan

          <li class="nav-item">


            <a class="nav-link" href="{{ route('logout') }}"
            onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                            <i class="nav-icon fas fa-power-off red"></i>
            <p>
            {{ __('Logout') }}
          </p>
        </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content">
      <div class="container-fluid">



        <router-view> </router-view>

        <vue-progress-bar></vue-progress-bar>

      </div>
    </div>
  </div>
  <!-- <aside class="control-sidebar control-sidebar-dark">

    <div class="p-3">
      <h5>Title</h5>
      <p>Sidebar content</p>
    </div>
  </aside> -->
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="float-right d-none d-sm-inline">
      Anyi
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; 2019 <a href="#">Anyi MultiApp</a>.</strong> All rights reserved.
  </footer>
</div>


@auth
<script>
    window.user = @json(auth()->user())
</script>
@endauth


<script type="text/javascript" src="js/app.js"></script>


{{-- <!-- jQuery -->
<!--
<script src="plugins/jquery/jquery.min.js"></script> -->
<!-- Bootstrap 4 --><!--
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script> -->
<!-- AdminLTE App --><!--
<script src="dist/js/adminlte.min.js"></script> --> --}}

</body>
</html>
