<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>@yield('title') | {{ env('APP_NAME') }} Admin</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('assets/admin/dist/css/adminlte.min.css')}}">
<style type="text/css">
  .small-box .icon {
    top: 10px !important;
  }
</style>
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  
  <meta name="application-name" content="MinePoS">
  <meta name="author" content="AndrewAubury & PiggyPiglet">
  <meta name="description" content="Self-Hosted Minecraft store">
  <meta name="keywords" content="Minecraft, MinePoS, free, Open Source">
  <meta name="theme-color" content="#A32A2A">

  <meta property="og:url" content="{{url()->current()}}" />
  <meta property="og:title" content="@yield('title') | {{ env('APP_NAME') }} Admin" />
  <meta property="og:description" content="@yield('desc')" />
  <meta property="og:image" content="{{url('assets/logo.png')}}" />
  @yield('head')
  
</head>
<body class="hold-transition sidebar-mini" style="height: auto;">
<!-- Site wrapper -->
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand bg-white navbar-light border-bottom">
      <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fa fa-bars"></i></a>
      </li>
    </ul>
    <ul class="navbar-nav ml-auto">
    <!-- User Account: style can be found in dropdown.less -->
    
          <!-- Control Sidebar Toggle Button -->
          <li class="nav-item">
            @can('edit settings')
            <a class="nav-link" href="@if(\Request::is('admin/settings*')) {{route('admin.dashboard')}} @else {{route('admin.settings')}} @endif"><i class="fa @if(\Request::is('admin/settings*')) fa-dashboard @else fa-gears @endif nav-icon"></i></a>
            @endcan
          </li>
      <li class="nav-item">
          <a class="nav-link" href="{{Route('logout')}}">
      <i class="fa fa-lock nav-icon"></i>
      </a>
    </li>
      <li class="nav-item">
          <a class="nav-link" href="{{Route('logout')}}">
      <i class="fa fa-sign-out nav-icon"></i>
      </a>
    </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4" style="min-height: 597px;overflow:hidden;">
    <!-- Brand Logo -->
  <a href="{{Route('admin.dashboard')}}" class="brand-link">
      <img src="{{url('assets/menulogo.png')}}" alt="MinePoS Logo" class="brand-image" style="opacity: .8">
      <span class="brand-text font-weight-light">{{ env('APP_NAME') }}</span>
    </a>
  
    <!-- Sidebar -->
    <div class="sidebar">
      
    
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{Gravatar::get(Auth::user()->email)}}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="{{Route('admin.account.changepassword')}}" class="d-block">{{Auth::user()->name}}</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
    
    @if(Auth::user()->getAllPermissions()->first() != null)
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
    
     
      @if(\Request::is('admin/settings*') == false)
          @include('admin.parts.navnormal')
        @else
          @include('admin.parts.navsettings')
        @endif
        </ul>
          @endif  

      
    </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" style="min-height: 597px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      @if(Updater::isNewVersionAvailable(\Updater::getVersionInstalled("v","")))
      <div class="alert alert-info" role="alert">
        There is a update available you are running {{\Updater::getVersionInstalled("v","")}}, the newest version is {{\Updater::getVersionAvailable()}}
      </div>
      @endif
      <h1>
        @yield('title')</h1>
        <small class="muted">@yield('desc')</small>
      
    </section>

    <!-- Main content -->
    <section class="content">
    @if (request()->session()->has('good'))
    <div class="alert alert-success" role="alert">
     {{session('good')}}
    </div>
    @endif
    @if (request()->session()->has('bad'))
    <div class="alert alert-danger" role="alert">
     {{session('bad')}}
    </div>
    @endif
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
  @yield('content')
  
    </section>

    <!-- Main content -->
    
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

<footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> {{\Updater::getVersionInstalled()}}
    </div>
    Copyright &copy; 2016 - {{date("Y")}} <strong><a href="https://minepos.net/">MinePoS</a></strong>
    <a href="#" style="color:transparent;">Oof</a>
  </footer>

<!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
    </div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="{{asset('assets/admin/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('assets/admin/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- SlimScroll -->
<script src="{{asset('assets/admin/plugins/slimScroll/jquery.slimscroll.min.js')}}"></script>
<!-- FastClick -->
<script src="{{asset('assets/admin/plugins/fastclick/fastclick.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('assets/admin/dist/js/adminlte.js')}}"></script>
<script src="{{asset('assets/admin/dist/js/demo.js')}}"></script>
@yield("extra")

</body></html>