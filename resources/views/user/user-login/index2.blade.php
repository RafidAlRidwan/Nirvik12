@extends('layouts.user.login')

@section('content')
<div class="login-content">
  <div class="form-box">
    {{Form::open(array('url' => 'login' , 'class' => 'box', 'method' => 'POST'))}}
    <img src="{{asset('assets/user/loginPage/img/bzs.png')}}">
    <h3 class="title">নির্ভীক '১২</h3>

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