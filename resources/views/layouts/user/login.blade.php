<!DOCTYPE html>
<html>

<head>
  <title>Login</title>
  <link rel="stylesheet" type="text/css" href="{{asset('assets/user/loginPage/css/style.css')}}">
  <!-- Google Fonts -->
  <link href="{{asset('assets/user/landingPage/css/googleFont.css')}}" rel="stylesheet">
  <!-- Notification -->
  <link rel="stylesheet" href="{{asset('assets/user/landingPage/notification/css/jquerysctipttop.css')}}">
  <link rel="stylesheet" href="{{asset('assets/user/landingPage/notification/css/flashy.min.css')}}">
  <!-- Font Awesome -->
  <link href="{{asset('assets/user/landingPage/lib/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  @yield('style')
  <style type="text/css">

  </style>
</head>

<body class="bg-img">
  <!-- <img class="wave" src="img/wave.png"> -->
  <div class="container">
    <div class="img">
      <!-- <img src="img/bg.svg"> -->
    </div>

    @yield('content')

  </div>
  <script type="text/javascript" src="{{asset('assets/user/loginPage/js/main.js')}}"></script>
  <script src="{{asset('assets/user/loginPage/js/font.js')}}"></script>
  <!-- Notification -->
  <script src="{{asset('assets/user/landingPage/datatable/js/jquery-3.5.1.js')}}"></script>
  <script src="{{asset('assets/user/landingPage/notification/js/flashy.min.js')}}"></script>
  <script type="text/javascript">
    <?php if ($message = Session::get('flashy__info')) : ?>
      flashy('<?php echo " $message" ?>', {
        type: 'flashy__info'
      });
    <?php endif ?>
  </script>
  @yield('script')
</body>

</html>