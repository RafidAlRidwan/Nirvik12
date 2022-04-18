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
       <link href="{{asset('assets/user/landingPage/img/favicon.png')}}" rel="icon">
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

       @yield('main-style')
       
       <!-- =======================================================
       Theme Name: TheEvent
       Theme URL: https://bootstrapmade.com/theevent-conference-event-bootstrap-template/
       Author: BootstrapMade.com
       License: https://bootstrapmade.com/license/
       ======================================================= -->
</head>