<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>@yield('title') | {{ env('APP_NAME') }} Admin</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="/admin/bower_components/bootstrap/dist/css/bootstrap.min.css">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="/admin/bower_components/font-awesome/css/font-awesome.min.css">

  <!-- Ionicons -->
  <link rel="stylesheet" href="/admin/bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="/admin/dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="/admin/dist/css/skins/skin-black.css">


  <meta name="application-name" content="MinePoS">
  <meta name="author" content="AndrewAubury & PiggyPiglet">
  <meta name="description" content="Self-Hosted Minecraft store">
  <meta name="keywords" content="Minecraft, MinePoS, free, Open Source">
  <meta name="theme-color" content="#A32A2A">

  <meta property="og:url" content="{{url()->current()}}" />
  <meta property="og:title" content="@yield('title') | {{ env('APP_NAME') }} Admin" />
  <meta property="og:description" content="@yield('desc')" />
  <meta property="og:image" content="{{url('/admin/logo.png')}}" />
@yield('head')
<!-- <style type="text/css">
.content-wrapper {
    min-height: 100%;
    background-color: #1c1c1c;
    z-index: 800;
}
body {
    font-family: "Helvetica Neue",Helvetica,Arial,sans-serif;
    font-size: 14px;
    line-height: 1.42857143;
    color: #ccc;
}
.main-footer {
    background: #151515;
    padding: 15px;
    color: #bdbdbd;
    border-top: 1px solid #151515;
}
.box {
    position: relative;
    border-radius: 3px;
    background: #242424;
    border-top: 3px solid #151515;
    margin-bottom: 20px;
    width: 100%;
    box-shadow: 0 1px 1px rgba(0,0,0,0.1);
}
.box-header{
  color: #ddd;
}
.table-hover > tbody > tr:hover {

    background-color: #1c1c1c;

}
.box-footer {
    border-top-left-radius: 0;
    border-top-right-radius: 0;
    border-bottom-right-radius: 3px;
    border-bottom-left-radius: 3px;
    border-top: 1px solid #1d1d1d;
    padding: 10px;
    background-color: #1d1d1d;
}
.form-control {
    display: block;
    width: 100%;
    height: 34px;
    padding: 6px 12px;
    font-size: 14px;
    line-height: 1.42857143;
    color: #fff;
    background-color: #555;
    background-image: none;
    border: 1px solid #555;
    border-radius: 4px;
  }
  .select2-container--default .select2-selection--single {
    background-color: #555;
    border: 1px solid #555;
    color: #fff;
    border-radius: 4px;
}
.select2-dropdown {
    background-color: #555;
    color: #fff;
    border: 1px solid #555;
 }
 .select2-container--default .select2-selection--single .select2-selection__rendered {
color: #fff;
  }
  .select2-container--default .select2-search--dropdown .select2-search__field{
        color: #fff;
    background-color: #555;
    background-image: none;
    border: 1px solid #555;
  }
</style> -->


  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-black sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="{{Route('admin.dashboard')}}" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini">{{ env('APP_NAME') }}</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg">{{ env('APP_NAME') }}</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
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
              <img src="{{Gravatar::get(Auth::user()->email)}}" class="user-image" alt="User Image">
              <span class="hidden-xs">{{Auth::user()->name}}</span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="{{Gravatar::get(Auth::user()->email)}}" width="160" class="img-circle" alt="User Image">

                <p>
                  {{Auth::user()->name}}
                  <small>{{Auth::user()->getRole()}}</small>
                </p>
              </li>
              <!-- Menu Body -->
              <li class="user-body">
                <!-- /.row -->
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="{{Route('admin.account.changepassword')}}" class="btn btn-default btn-flat">Profile</a>
                </div>
                <div class="pull-right">
                  <a href="{{Route('logout')}}" class="btn btn-default btn-flat">Sign out</a>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
          <li>
            @can('edit settings')
            <a href="@if(\Request::is('admin/settings*')) {{route('admin.dashboard')}} @else {{route('admin.settings')}} @endif"><i class="fa @if(\Request::is('admin/settings*')) fa-dashboard @else fa-gears @endif"></i></a>
            @endcan
          </li>
        </ul>
      </div>
    </nav>
  </header>

  <!-- =============================================== -->

  <!-- Left side column. contains the sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="{{Gravatar::get(Auth::user()->email)}}" width="160" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>{{Auth::user()->name}}</p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
 
      </form>
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      @if(Auth::user()->getAllPermissions()->first() != null)
      <ul class="sidebar-menu" data-widget="tree">
<!--         <li class="header">MAIN NAVIGATION</li> -->
        @if(\Request::is('admin/settings*') == false)
          @include('admin.parts.navnormal')
        @else
          @include('admin.parts.navsettings')
        @endif
      </ul>
      @endif
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- =============================================== -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      @if(Updater::isNewVersionAvailable(\Updater::getVersionInstalled("v","")))
      <div class="alert alert-info" role="alert">
        There is a update available you are running {{\Updater::getVersionInstalled("v","")}}, the newest version is {{\Updater::getVersionAvailable()}}
      </div>
      @endif
      <h1>
        @yield('title')
        <small>@yield('desc')</small>
      </h1>
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
</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="/admin/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="/admin/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="/admin/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="/admin/bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="/admin/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="/admin/dist/js/demo.js"></script>
<script>
  $(document).ready(function () {
    $('.sidebar-menu').tree()
  })
</script>
@yield('extra')
</body>
</html>
