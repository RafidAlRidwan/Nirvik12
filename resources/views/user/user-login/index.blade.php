@extends('layouts.user.login')

@section('style')
<style>
  .anm
  {
    -webkit-animation-name: rotate;
    -webkit-animation-duration:50s;
    -webkit-animation-iteration-count:infinite;
    -webkit-animation-timing-function:linear;
    -moz-animation-name: rotate;
    -moz-animation-duration:50s;
    -moz-animation-iteration-count:infinite;
    -moz-animation-timing-function:linear;
  }

  @-webkit-keyframes rotate {
    from {-webkit-transform:rotate(0deg);}
    to {  -webkit-transform:rotate(360deg);}
  }

  @-moz-keyframes rotate {
    from {-moz-transform:rotate(0deg);}
    to {  -moz-transform:rotate(360deg);}
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
    {{Form::open(array('url' => 'login' , 'class' => 'box', 'method' => 'POST'))}}
    <img class="anm" src="{{asset('assets/user/loginPage/img/bzs.png')}}">
    <!-- <h3 class="title">নির্ভীক '১২</h3> -->
    <a href={{route('landingPage')}}><img src="{{asset($banner->value)}}" alt="নির্ভীক'১২"></a>

    <input type="text" name="name" placeholder="Username" autocomplete="off" class="input" required="">

    <input type="password" name="password" placeholder="Password" autocomplete="off" class="input" required="">

    @php $url = URL::to('/user/forget/password'); @endphp
    <a style="padding: 1px; justify-content: center" href="{{$url}}">Forgot Password?</a>
    <div style="justify-content: center">
      <button type="submit" class="btn">Login</button>
    </div>
    {{ Form::close() }}
    <div style="text-align: center; color: #f82249; background-color: #none; display: block;"><span>{{ $errors->first('name') }} </span></div>
  </div>
</div>
@endsection