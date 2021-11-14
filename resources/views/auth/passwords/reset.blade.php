@extends('layouts.user.login')

@section('content')
<div class="login-content">
<div class="form-box">
      <form method="POST" class="box" action="{{ route('password.update') }}">
          @csrf
          <input type="hidden" name="token" value="{{ $token }}">
        <img src="{{asset('assets/user/loginPage/img/bzs.png')}}">
        <h3  class="title">নির্ভীক '১২</h3>
              
                    <input id="email" type="email" class="input @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="off" autofocus>
                 
                    <input id="password" type="password" class="input @error('password') is-invalid @enderror" name="password" placeholder="New Password" required autocomplete="new-password">
                 
                    <input id="password-confirm" type="password" class="input" name="password_confirmation" required placeholder="Confirm Password" autocomplete="new-password">
                 
              <div style="justify-content: center">
               <button type="submit" class="btn">Reset</button>
              </div>

                    @error('email')
                        <span style="color: red" class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                    @error('password')
                        <span style="color: red" class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                        </span>
                    @enderror
            </form>
        </div>
      </div>
@endsection