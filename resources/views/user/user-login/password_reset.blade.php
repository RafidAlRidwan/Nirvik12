@extends('layouts.user.login')
@section('style')
@endsection
@section('content')
<div class="login-content">
  <div class="form-box">
    <form method="POST" class="box" action="{{ route('password.email') }}">
      @csrf
      <img src="{{asset('assets/user/loginPage/img/bzs.png')}}">
      <h3 class="title">নির্ভীক '১২</h3>

      <input type="email" id="email" name="email" placeholder="E-Mail Address" autocomplete="off" value="{{ old('email') }}" class="input @error('email') is-invalid @enderror" required autocomplete="off">


      <div style="justify-content: center">
        <button type="submit" class="btn">{{ __('Send Link') }}</button>
      </div>
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


    </form>
  </div>
</div>
@endsection

@section('script')

@endsection