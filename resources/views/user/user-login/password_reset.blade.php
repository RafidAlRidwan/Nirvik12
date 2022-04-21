@extends('layouts.user.login')
@section('style')
@endsection
@section('content')
@php
$cache = Cache::get('settings');
$banner = $cache->where('key', 'banner')->first();
@endphp
<div class="login-content">
  <div class="form-box">
    <form method="POST" class="box" action="{{ route('password.email') }}">
      @csrf
      <img src="{{asset('assets/user/loginPage/img/bzs.png')}}">
      <a href={{route('landingPage')}}><img src="{{asset($banner->value)}}" alt="নির্ভীক'১২"></a>

      <input type="email" id="email" name="email" placeholder="E-Mail Address" autocomplete="off" value="{{ old('email') }}" class="input @error('email') is-invalid @enderror" required autocomplete="off">
      @if (session('status'))
      <div style="color: green;" class="alert alert-success" role="alert">
        <strong>{{ session('status') }}</strong>
      </div>
      @endif
      @error('email')
      <span style="color: red;" class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
      </span>
      @enderror

      <div style="justify-content: center">
        <button type="submit" class="btn">{{ __('Send Link') }}</button>
      </div>
    </form>
    <div style="justify-content: center">
      <a href={{route('user_login')}}><button class="btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i></button></a>
    </div>
  </div>
</div>
@endsection

@section('script')

@endsection