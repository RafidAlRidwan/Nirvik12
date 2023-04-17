<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Admin | Dashboard</title>
  <link href="{{asset('assets/user/loginPage/img/bzs.png')}}" rel="icon">

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="{{asset('assets/admin/fonts/font.css')}}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('assets/admin/plugins/fontawesome-free/css/all.min.css')}}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{asset('assets/admin/fonts/ionicons.min.css')}}">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="{{asset('assets/admin/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{asset('assets/admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
  <!-- JQVMap -->
  <link rel="stylesheet" href="{{asset('assets/admin/plugins/jqvmap/jqvmap.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('assets/admin/dist/css/adminlte.min.css')}}">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{asset('assets/admin/plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="{{asset('assets/admin/plugins/daterangepicker/daterangepicker.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('assets/admin/plugins/summernote/summernote-bs4.min.css')}}">
  <link rel="stylesheet" href="{{asset('assets/admin/plugins/toastr/toastr.min.css')}}">
  <!-- Select2 -->
  <link rel="stylesheet" href="{{asset('assets/admin/plugins/select2/css/select2.min.css')}}">
  <link rel="stylesheet" href="{{asset('assets/admin/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
  <!-- DATA TABLE -->
  <link rel="stylesheet" href="{{asset('assets/admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{asset('assets/admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">

  <style type="text/css">
    .right ul {
      list-style: none;
      padding: 0;
    }

    .right ul li a {
      display: flex;
      align-items: center;
      height: 5px;
    }

    .right img {
      margin: 0 10px;
      border-radius: 50%;
    }

    .right a {
      text-align: right;
    }

    .right a span {
      font-size: 10px;
    }

    .right ul li {
      position: relative;
    }

    .dropdown ul li {
      padding: 10px;
    }

    .right ul li .dropdown {
      position: absolute;
      top: 70px;
      right: 0;
      background: #fff;
      padding: 10px 25px;
      border-radius: 5px;
      display: none;
    }

    .right ul li .dropdown .fas {
      margin-right: 10px;
    }

    .right ul li .dropdown:before {
      content: "";
      position: absolute;
      top: -20px;
      left: 78%;
      transform: translateX(-50%);
      border: 10px solid;
      border-color: transparent transparent #fff transparent;
    }

    .right ul li.active .dropdown {
      display: block;
    }

    .sidebar-dark-primary .nav-sidebar>.nav-item>.nav-link.active,
    .sidebar-light-primary .nav-sidebar>.nav-item>.nav-link.active {
      /* background-color: #f82249; */
      background-color: rgba(255, 255, 255, .1);

      border-radius: 30px 0px 0px 30px;
      color: #fff;
      border-right: 4px solid #f82249;
    }

    [class*=sidebar-dark-] .nav-sidebar>.nav-item.menu-open>.nav-link,
    [class*=sidebar-dark-] .nav-sidebar>.nav-item:hover>.nav-link,
    [class*=sidebar-dark-] .nav-sidebar>.nav-item>.nav-link:focus {
      color: #fff;
      border-radius: 30px 0px 0px 30px;
      border-right: 4px solid #f82249;
    }
  </style>
  @yield('style')
</head>

<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <!-- <li class="nav-item d-none d-sm-inline-block">
        <a href="index3.html" class="nav-link">Home</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Contact</a>
      </li> -->
      </ul>

      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">
        <!-- Navbar Search -->
        <li class="nav-item">


        </li>

        <!-- Messages Dropdown Menu -->
        <li class="nav-item dropdown">


        </li>
        <!-- Notifications Dropdown Menu -->
        <li class="nav-item dropdown">
          <div class="right">
            <ul>
              <li>
                <a href="#">
                  <p><img src="{{asset('assets/user/landingPage/img/profilePicture/demo.jpg')}}" alt="Admin" width="40">
                </a>

                <div class="dropdown">
                  <ul>
                    <!-- <li class="p-3"><a href={{route('landingPage')}}></i><strong>Goto Website</strong></a></li> -->
                    <li class="p-3"><a href="#"><i class="fas fa-user"></i> {{Session::get('userName') ?? NULL}}</a></li>
                    <li class="p-3"><a href="{{URL::to('/admin/settings')}}"><i class="fas fa-sliders-h"></i> Settings</a></li>
                    <li class="p-3"><a href="{{route('landingPage')}}"><i class="fa fa-desktop" style="padding-right: 9px;"></i> Website</a></li>
                    <li class="p-3"><a onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();" href="{{ route('logout') }}"><i class="fas fa-sign-out-alt"></i> Signout</a></li>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                      @csrf
                    </form>
                  </ul>
                </div>

              </li>
            </ul>
          </div>
  </div>
  </div>

  </li>

  </ul>
  </nav>
  <!-- /.navbar -->
  @php
  $cache = Cache::get('settings');
  $banner = $cache->where('key', 'banner')->first();
  @endphp
  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link text-center">
      <!-- <img src="{{asset('assets/admin/dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8"> -->
      <img height="60px" src="{{asset($banner->value)}}" alt="" title="">
    </a>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel d-flex">

      </div>



      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          @php $path = Request::path(); @endphp
          <li class="nav-item">
            <a href="{{URL::to('/admin/dashboard')}}" class="nav-link <?php if ($path == 'admin/dashboard' || $path == 'user/dashboard') {
                                                                        echo "active";
                                                                      } else {
                                                                        echo "";
                                                                      } ?>">

              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
                </i>
              </p>
            </a>
            <!-- <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{URL::to('/admin/user_management')}}" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Dashboard v1</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{URL::to('/admin/user_management')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Dashboard v2</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{URL::to('/admin/user_management')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Dashboard v3</p>
                </a>
              </li>
            </ul> -->
          </li>
          <li class="nav-item">
            <a href="{{URL::to('/admin/user_management')}}" class="nav-link 
            {{request()->is('admin/user_management') ? 'active' : ''}} ||
            {{request()->is('admin/user/*') ? 'active' : ''}}">
              <i class="nav-icon fas fa-users"></i>
              <p>
                User Management
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{URL::to('/admin/cover-page/setting')}}" class="nav-link 
            {{request()->is('admin/cover-page/*') ? 'active' : ''}}">
              <i class="nav-icon fa fa-desktop"></i>
              <p>
                Cover Page Settings
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{URL::to('/admin/about/setting/1')}}" class="nav-link 
            {{request()->is('admin/about/*') ? 'active' : ''}}">
              <i class="nav-icon fas fa-book"></i>
              <p>
                About Settings
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{URL::to('/admin/blog/setting')}}" class="nav-link
            {{request()->is('admin/blog/setting') ? 'active' : ''}}">
              <i class="nav-icon fa fa-rss-square" aria-hidden="true"></i>
              <p>
                Blog Settings
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{URL::to('/admin/news/setting')}}" class="nav-link 
            {{request()->is('admin/news/*') ? 'active' : ''}}">
              <i class="nav-icon far fa-newspaper"></i>
              <p>
                News Settings
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{URL::to('/admin/event/setting')}}" class="nav-link
            {{request()->is('admin/event/*') ? 'active' : ''}}">
              <i class="nav-icon far fa-calendar"></i>
              <p>
                Event Settings
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{URL::to('/admin/committee/setting')}}" class="nav-link
            {{request()->is('admin/committee/*') ? 'active' : ''}}">
              <i class="nav-icon fa fa-podcast"></i>
              <p>
                Committee Setup
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{URL::to('/admin/album/setting')}}" class="nav-link 
            {{request()->is('admin/album/*') ? 'active' : ''}}">
              <i class="nav-icon far fa-folder-open"></i>
              <p>
                Album Settings
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{URL::to('/admin/gallery/setting')}}" class="nav-link 
            {{request()->is('admin/gallery/*') ? 'active' : ''}}">
              <i class="nav-icon far fa-image"></i>
              <p>
                Gallery Settings
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{URL::to('/admin/sponsor/setting')}}" class="nav-link 
            {{request()->is('admin/sponsor/*') ? 'active' : ''}}">
              <i class="nav-icon fa fa-hourglass"></i>
              <p>
                Sponsor Settings
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{URL::to('/admin/settings')}}" class="nav-link
            {{request()->is('admin/settings') ? 'active' : ''}}">
              <i class="nav-icon fa fa-cog"></i>
              <p>
                General Settings
              </p>
            </a>
          </li>
          <!-- <li class="nav-item menu-open">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas fa-table"></i>
              <p>
                Tables
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="../tables/simple.html" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Simple Tables</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="../tables/data.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>DataTables</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="../tables/jsgrid.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>jsGrid</p>
                </a>
              </li>
            </ul>
          </li> -->

        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->

  <div class="content-wrapper">
    @yield('content')
  </div>
  <!-- /.content-wrapper -->
  @php
  $app_name = Cache::get('settings')->where('key', 'app_name')->first();
  @endphp
  <footer class="main-footer">
    <strong>Copyright &copy; 2022 <a href="https://adminlte.io">{{$app_name->value}} TEAM</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 2.0
    </div>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
  </div>
  <!-- ./wrapper -->

  <!-- jQuery -->
  <script src="{{asset('assets/admin/plugins/jquery/jquery-3.6.0.min.js')}}"></script>
  <!-- jQuery Validate-->
  <script src="{{asset('assets/admin/plugins/jquery/jquery.validate.js')}}"></script>
  <!-- jQuery UI 1.11.4 -->
  <script src="{{asset('assets/admin/plugins/jquery-ui/jquery-ui.min.js')}}"></script>
  <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
  <script>
    $.widget.bridge('uibutton', $.ui.button)
  </script>
  <!-- Bootstrap 4 -->
  <script src="{{asset('assets/admin/plugins/bootstrap/js/bootstrap.min.js')}}"></script>
  <script src="{{asset('assets/admin/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>


  <!-- ChartJS -->
  <script src="{{asset('assets/admin/plugins/chart.js/Chart.min.js')}}"></script>
  <!-- Sparkline -->
  <script src="{{asset('assets/admin/plugins/sparklines/sparkline.js')}}"></script>
  <!-- JQVMap -->
  <script src="{{asset('assets/admin/plugins/jqvmap/jquery.vmap.min.js')}}"></script>
  <script src="{{asset('assets/admin/plugins/jqvmap/maps/jquery.vmap.usa.js')}}"></script>
  <!-- jQuery Knob Chart -->
  <script src="{{asset('assets/admin/plugins/jquery-knob/jquery.knob.min.js')}}"></script>

  <!-- daterangepicker -->
  <script src="{{asset('assets/admin/plugins/moment/moment.min.js')}}"></script>
  <script src="{{asset('assets/admin/plugins/daterangepicker/daterangepicker.js')}}"></script>
  <!-- Tempusdominus Bootstrap 4 -->
  <script src="{{asset('assets/admin/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>
  <!-- overlayScrollbars -->
  <script src="{{asset('assets/admin/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
  <!-- Select2 -->
  <script src="{{asset('assets/admin/plugins/select2/js/select2.full.min.js')}}"></script>
  <!-- AdminLTE App -->
  <script src="{{asset('assets/admin/dist/js/adminlte.js')}}"></script>
  <script src="{{asset('assets/admin/plugins/summernote/summernote-bs4.min.js')}}"></script>
  <script src="{{asset('assets/admin/plugins/toastr/toastr.min.js')}}"></script>
  <!-- DATA TABLES -->
  <script src="{{asset('assets/admin/plugins/datatables/jquery.dataTables.min.js')}}"></script>
  <script src="{{asset('assets/admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
  <script src="{{asset('assets/admin/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
  <script src="{{asset('assets/admin/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
  <script type="text/javascript">
    // $(document).on('click' , 'ul li', function(){
    //     alert('Hi');
    //     $(this).addClass('active').siblings().removeClass('active')
    // });
  </script>
  <script type="text/javascript">
    document.querySelector(".right ul li").addEventListener("click", function() {
      this.classList.toggle("active");
    });
  </script>
  <script type="text/javascript">
    <?php if ($message = Session::get('flashy__info')) : ?>
      toastr.info('<?php echo " $message" ?>', {});
    <?php endif ?>

    <?php if ($message = Session::get('flashy__warning')) : ?>
      toastr.warning('<?php echo " $message" ?>', {});
    <?php endif ?>

    <?php if ($message = Session::get('flashy__danger')) : ?>
      toastr.error('<?php echo " $message" ?>', {});
    <?php endif ?>

    <?php if ($message = Session::get('flashy__success')) : ?>
      toastr.success('<?php echo " $message" ?>', {});
    <?php endif ?>
  </script>
  @yield('script')
</body>

</html>