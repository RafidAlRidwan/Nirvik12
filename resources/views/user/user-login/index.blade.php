@extends('layouts.user.login')

@section('style')
<style>
  .anm {
    -webkit-animation-name: rotate;
    -webkit-animation-duration: 50s;
    -webkit-animation-iteration-count: infinite;
    -webkit-animation-timing-function: linear;
    -moz-animation-name: rotate;
    -moz-animation-duration: 50s;
    -moz-animation-iteration-count: infinite;
    -moz-animation-timing-function: linear;
  }


  @-webkit-keyframes rotate {
    from {
      -webkit-transform: rotate(0deg);
    }

    to {
      -webkit-transform: rotate(360deg);
    }
  }

  @-moz-keyframes rotate {
    from {
      -moz-transform: rotate(0deg);
    }

    to {
      -moz-transform: rotate(360deg);
    }
  }

  .fb:hover {
    transform: scale(1.2);
  }


  .google:hover {
    transform: scale(1.2);
  }

  .form-box {
    animation: fadeInDown 1s;
  }

  .icon-close {
    position: absolute;
    top: 0;
    right: 0;
    width: 45px;
    height: 45px;
    background-color: #000;
    color: white;
    font-size: 1.2em;
    display: flex !important;
    justify-content: center !important;
    align-items: center !important;
    border-bottom-left-radius: 1rem;
    cursor: pointer;
    z-index: 1;
  }

  .icon-close:hover {
    background-color: #f82249;
    transition: 0.3s;
  }

  @keyframes fadeInDown {
    0% {
      opacity: 0;
      -webkit-transform: translate3d(0, -100%, 0);
      transform: translate3d(0, -100%, 0);
    }

    100% {
      opacity: 1;
      -webkit-transform: none;
      transform: none;
    }
  }

  .logo:hover {
    animation: shake 0.82s cubic-bezier(.36, .07, .19, .97) both;
    transform: translate3d(0, 0, 0);
    backface-visibility: hidden;
    perspective: 1000px;
  }

  @keyframes shake {

    10%,
    90% {
      transform: translate3d(-1px, 0, 0);
    }

    20%,
    80% {
      transform: translate3d(2px, 0, 0);
    }

    30%,
    50%,
    70% {
      transform: translate3d(-4px, 0, 0);
    }

    40%,
    60% {
      transform: translate3d(4px, 0, 0);
    }
  }
</style>
@endsection

@section('content')
@php
$cache = Cache::get('settings');
$banner = $cache->where('key', 'banner')->first();
@endphp
<div class="login-content">
  <div class="form-box">
    <a href="{{url('/')}}"><span><i class="fa fa-times icon-close" aria-hidden="true"></i></span></a>
    {{Form::open(array('url' => 'login' , 'class' => 'box', 'method' => 'POST'))}}
    <img class="anm" src="{{asset('assets/user/loginPage/img/bzs.png')}}">
    <!-- <h3 class="title">নির্ভীক '১২</h3> -->
    <a href={{route('landingPage')}}><img class="logo" src="{{asset($banner->value)}}" alt="নির্ভীক'১২"></a>

    <input type="text" name="name" placeholder="Username" autocomplete="off" class="input" required="">

    <input type="password" name="password" placeholder="Password" autocomplete="off" class="input" required="">

    @php $url = URL::to('/user/forget/password'); @endphp
    <a style="padding: 1px; justify-content: center" href="{{$url}}">Forgot Password?</a>
    <div style="justify-content: center">
      <button type="submit" class="btn">Login</button>
    </div>
    <div style="justify-content: center; display: flex;">
      <a class="fb" href=""><img style="width: 40px; height: 40px" src="{{asset('/assets/user/loginPage/img/fb.png')}}"></a>
      <a class="google" href="{{route('auth.google')}}"><img style="width: 40px; height: 40px" src="{{asset('/assets/user/loginPage/img/google.png')}}"></a>
    </div>


    {{ Form::close() }}
    <div style="text-align: center; color: #f82249; background-color: #none; display: block;"><span>{{ $errors->first('name') }} </span></div>
  </div>
</div>
</div>
@endsection