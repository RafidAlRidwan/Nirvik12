<!DOCTYPE html>
<html lang="en">
@php
$cache = Cache::get('settings');
$app_name = $cache->where('key', 'app_name')->first();
$banner = $cache->where('key', 'banner')->first();
@endphp

<head>
    <meta charset="utf-8">
    <title>{{$app_name->value}}</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Favicons -->
    <link href="{{asset('assets/user/landingPage/img/favicon.png')}}" rel="icon">
    <link href="{{asset('assets/user/landingPage/img/apple-touch-icon.png')}}" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="{{asset('assets/user/landingPage/css/googleFont.css')}}" rel="stylesheet">

    <!-- Bootstrap CSS File -->
    <!-- <link href="{{asset('assets/user/landingPage/css/bootstrap.min.css')}}" rel="stylesheet"> -->
    <link href="{{asset('assets/user/landingPage/lib/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">

    <!-- Libraries CSS Files -->
    <link href="{{asset('assets/user/landingPage/css/all.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/user/landingPage/lib/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/user/landingPage/lib/animate/animate.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/user/landingPage/lib/venobox/venobox.css')}}" rel="stylesheet">
    <link href="{{asset('assets/user/landingPage/lib/owlcarousel/assets/owl.carousel.min.css')}}" rel="stylesheet">

    <!-- Main Stylesheet File -->
    <link href="{{asset('assets/user/landingPage/css/styles.css')}}" rel="stylesheet">

    <!-- Notification -->
    <link rel="stylesheet" href="{{asset('assets/user/landingPage/notification/css/jquerysctipttop.css')}}">
    <link rel="stylesheet" href="{{asset('assets/user/landingPage/notification/css/flashy.min.css')}}">

    <!-- CUSTOM SELECT -->
    <link rel="stylesheet" href="{{asset('assets/user/landingPage/custom-select/css/style.css')}}">
    <!-- DATA TABLE -->
    <link rel="stylesheet" href="{{asset('assets/user/landingPage/datatable/css/jquery.dataTables.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/user/landingPage/datatable/css/fixedHeader.bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/user/landingPage/datatable/css/responsive.bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/user/landingPage/datatable/css/buttons.dataTables.min.css')}}">
    <style type="text/css">
        ::-webkit-scrollbar {
            width: 0px;
            background: #000;
        }

        ::-webkit-scrollbar-track {
            border-radius: 5px;
            box-shadow: inset 0 0 10px rgba(0, 0, 0, 0.25);
        }

        ::-webkit-scrollbar-thumb {
            border-radius: 5px;
            background-color: #f82249;
        }

        ::-webkit-scrollbar-thumb:hover {
            background-color: #f82249;
        }
    </style>
    @yield('style')

</head>

<body>
    @include('layouts.user.landing-page.header')

    ==========================Header============================
    <!-- <header id="header" class="header-fixed">
        <div class="container">

            <div id="logo" class="pull-left">
                <a href="#intro" class="scrollto"><img src="" alt="" title=""></a>
            </div>

            <nav id="nav-menu-container">
                <ul class="nav-menu">
                    
                    <li class="{{request()->is('user/dashboard') ? 'menu-active' : ''}}">
                        <a href="{{URL::to('user/dashboard')}}">Dashboard</a>
                    </li>

                    <li class="{{request()->is('user/committee/*') ? 'menu-active' : ''}}">
                        <a href="{{URL::to('user/committee/')}}" class="">Committee</a>
                    </li>

                    <li class="{{request()->is('blog') ? 'menu-active' : ''}} ||
                    {{request()->is('blog/*') ? 'menu-active' : ''}}">
                        <a href="{{route('blog')}}" class="">Blogs</a>
                    </li>

                    <li class="{{request()->is('user/my-profile/*') ? 'menu-active' : ''}}">
                        <a href="" class="">My Profile</a>
                    </li>

                    <li class="buy-tickets"><a onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();" href="{{ route('logout') }}">logout</a></li>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </ul>
            </nav>
        </div>
    </header> -->

    <main id="main" class="main-page">

        <div class="home">
            @yield('content')
        </div>
    </main>

    <!-- JavaScript Libraries -->
    <script src="{{asset('assets/user/landingPage/datatable/js/jquery-3.5.1.js')}}"></script>
    <!-- <script src="{{asset('assets/user/landingPage/js/bootstrap.min.js')}}"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script src="{{asset('assets/user/landingPage/lib/jquery/jquery-migrate.min.js')}}"></script>
    <script src="{{asset('assets/user/landingPage/lib/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('assets/user/landingPage/lib/easing/easing.min.js')}}"></script>
    <script src="{{asset('assets/user/landingPage/lib/superfish/hoverIntent.js')}}"></script>
    <script src="{{asset('assets/user/landingPage/lib/superfish/superfish.min.js')}}"></script>
    <script src="{{asset('assets/user/landingPage/lib/wow/wow.min.js')}}"></script>
    <script src="{{asset('assets/user/landingPage/lib/venobox/venobox.min.js')}}"></script>
    <script src="{{asset('assets/user/landingPage/lib/owlcarousel/owl.carousel.min.js')}}"></script>

    <!-- Contact Form JavaScript File -->
    <script src="{{asset('assets/user/landingPage/contactform/contactform.js')}}"></script>

    <!-- DATA TABLES -->
    <script src="{{asset('assets/user/landingPage/datatable/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('assets/user/landingPage/datatable/js/dataTables.bootstrap.min.js')}}"></script>
    <script src="{{asset('assets/user/landingPage/datatable/js/dataTables.fixedHeader.min.js')}}"></script>
    <script src="{{asset('assets/user/landingPage/datatable/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('assets/user/landingPage/datatable/js/responsive.bootstrap.min.js')}}"></script>
    <script src="{{asset('assets/user/landingPage/datatable/js/dataTables.buttons.min.js')}}"></script>
    <script src="{{asset('assets/user/landingPage/datatable/js/jszip.min.js')}}"></script>
    <script src="{{asset('assets/user/landingPage/datatable/js/pdfmake.min.js')}}"></script>
    <script src="{{asset('assets/user/landingPage/datatable/js/vfs_fonts.js')}}"></script>
    <script src="{{asset('assets/user/landingPage/datatable/js/buttons.html5.min.js')}}"></script>
    <script src="{{asset('assets/user/landingPage/datatable/js/buttons.print.min.js')}}"></script>
    <!-- Vue Js -->
    <script src="{{asset('assets/user/landingPage/vue/vue@2.6.14')}}"></script>
    <script src="{{asset('assets/user/landingPage/vue/vue-resource@1.5.3')}}"></script>
    <!-- CUSTOM SELECT -->
    <script src="{{asset('assets/user/landingPage/custom-select/js/jquery.nice-select.min.js')}}"></script>
    <script src="{{asset('assets/user/landingPage/custom-select/js/fastclick.js')}}"></script>
    <script src="{{asset('assets/user/landingPage/custom-select/js/prism.js')}}"></script>
    @yield('script')

    <!-- Template Main Javascript File -->
    <script src="{{asset('assets/user/landingPage/js/main.js')}}"></script>

    <!-- Notification -->
    <script src="{{asset('assets/user/landingPage/notification/js/flashy.min.js')}}"></script>
    @include('layouts.user.landing-page.message')

    </div>
</body>

</html>