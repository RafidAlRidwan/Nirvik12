<head>
       @php
       $cache = Cache::get('settings');
       $app_name = $cache->where('key', 'app_name')->first();
       @endphp
       <meta charset="utf-8">
       <title>{{$app_name->value}}</title>
       <meta content="width=device-width, initial-scale=1.0" name="viewport">
       <meta content="" name="keywords">
       <meta content="" name="description">
       <meta name="csrf-token" content="{{ csrf_token() }}">

       <!-- Favicons -->
       <link href="{{asset('assets/user/loginPage/img/bzs.png')}}" rel="icon">
       <link href="{{asset('assets/user/landingPage/img/apple-touch-icon.png')}}" rel="apple-touch-icon">

       <!-- Google Fonts -->
       <link href="{{asset('assets/user/landingPage/css/googleFont.css')}}" rel="stylesheet">

       <!-- Bootstrap CSS File -->
       <link href="{{asset('assets/user/landingPage/lib/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">

       <!-- Libraries CSS Files -->
       <link href="{{asset('assets/user/landingPage/lib/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">
       <link href="{{asset('assets/user/landingPage/lib/animate/animate.min.css')}}" rel="stylesheet">
       <link href="{{asset('assets/user/landingPage/lib/venobox/venobox.css')}}" rel="stylesheet">
       <link href="{{asset('assets/user/landingPage/lib/owlcarousel/assets/owl.carousel.min.css')}}" rel="stylesheet">

       <!-- Main Stylesheet File -->
       <link href="{{asset('assets/user/landingPage/css/style.css')}}" rel="stylesheet">

       <!-- Notification -->
       <link rel="stylesheet" href="{{asset('assets/user/landingPage/notification/css/jquery.notification.css')}}">

       <!-- Event -->
       <link rel="stylesheet" href="{{asset('assets/user/landingPage/css/event.css')}}">

       <!-- Carosoul Slider -->
       <link rel="stylesheet" href="{{asset('assets/user/landingPage/slider/css/swiper.min.css')}}">
       <link rel="stylesheet" href="{{asset('assets/user/landingPage/slider/css/style.css')}}">

       <!-- Preloader -->
       <link rel="stylesheet" href="{{asset('assets/user/landingPage/css/preloader.css')}}">

       <!-- Alert -->
       <link rel="stylesheet" type="text/css" href="{{asset('assets/admin/plugins/toastr/toastr.min.css')}}">

       <!-- Notification -->
       <link rel="stylesheet" href="{{asset('assets/user/landingPage/notification/css/jquerysctipttop.css')}}">
       <link rel="stylesheet" href="{{asset('assets/user/landingPage/notification/css/flashy.min.css')}}">

       <!-- Bangla Font -->
       <link href="https://fonts.maateen.me/charukola-ultra-light/font.css" rel="stylesheet">

       <style>
              .page-item.active .page-link {
                     z-index: 1;
                     background-color: #f82249;
                     border-color: #f82249;
              }

              .page-link {
                     color: #f82249;
              }
       </style>
       @yield('main-style')
       <style>
              .page-header .container {
                     padding-top: 36px;
                     padding-bottom: 36px;
                     position: relative;
                     animation: pop-in 2.5s ease-out;
              }

              .container {
                     max-width: 1140px;
                     padding-right: 30px;
                     padding-left: 30px;
                     margin-right: auto;
                     margin-left: auto;
              }

              .custom-section {
                     width: 100%;
                     height: auto;
                     background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url(/assets/user/landingPage/img/map.jpg) center;
                     background-size: cover;
                     overflow: hidden;
                     position: relative;
              }

              @media (min-width: 768px) {
                     .page-header .container {
                            padding-top: 100px;
                            /* padding-bottom: 48px; */
                     }
              }

              @media (max-width: 768px) {
                     .page-header .container {
                            padding-top: 100px;
                            /* padding-bottom: 48px; */
                     }
              }
       </style>
       <style>
              .media-icons {
                     display: none;
              }
       </style>
       <link href="{{asset('assets/user/landingPage/css/april-custom.css')}}" rel="stylesheet">
       <!-- =======================================================
       Theme Name: TheEvent
       Theme URL: https://bootstrapmade.com/theevent-conference-event-bootstrap-template/
       Author: BootstrapMade.com
       License: https://bootstrapmade.com/license/
       ======================================================= -->
</head>