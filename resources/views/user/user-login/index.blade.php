@extends('layouts.user.login')
@section('style')
<link href="https://fonts.maateen.me/charukola-ultra-light/font.css" rel="stylesheet">
<style type="text/css">
  .f9{
    font-family: 'CharukolaUltraLight', Open Sans, sans-serif;
  }
</style>
@endsection
@section('content')
<div class="login-content">
<div class="form-box">
      {{Form::open(array('url' => 'login' , 'method' => 'POST'))}}
        <img src="{{asset('assets/user/loginPage/img/bzs.png')}}">
        <h3 class="f9 title">নির্ভীক '১২</h3>
              <div class="input-div one">
                 <div class="i">
                    <i class="fa fa-user"></i>
                 </div>
                 <div class="div">
                    <h5>Username</h5>
                    <input type="text" name="name" autocomplete="off" class="input" required="">
                 </div>
              </div>
              <div class="input-div pass">
                 <div class="i"> 
                    <i class="fa fa-lock"></i>
                 </div>
                 <div class="div">
                    <h5>Password</h5>
                    <input type="password" name="password" autocomplete="off" class="input" required="">
                    
                 </div>

              </div>
              @php $url = URL::to('/user/forget/password'); @endphp
              <a style="padding: 1px;" href="{{$url}}">Forgot Password?</a>
              <div style="justify-content: center">
               <button type="submit" class="btn">Login</button>
              </div>
            {{ Form::close() }}
            <div style="text-align: center; color: #f82249; background-color: #none; display: block;"><span>{{ $errors->first('name') }} </span></div>
        </div>
      </div>
@endsection