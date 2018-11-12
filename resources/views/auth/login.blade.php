@extends('layouts.layout', [
    'image' => 'balloon-cutout',
    'css' => 'plan'
])

@section('content')

<div class="background">
<div class="fade">
<div class="container_form">
<div class="form">
<div class="email">
  <form class="" id="login-form" method="POST" action="{{ route('login') }}">
  @csrf
  <div class="email1">
    <label for="email" class="login_labels"><img src="img\email.svg" alt="email_logo"></label>
    <input id="email" placeholder="E-Mail Address" type="email" class="email_input{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>
    @if ($errors->has('email'))
    <span class="invalid-feedback" role="alert">
    <strong>{{ $errors->first('email') }}</strong>
    </span>
    @endif
  </div>
</div>
<div class="password">
      <label for="password" class="login_labels"><img src="img/padlock.svg" alt="padlock_logo"></label>
      <div class="password" placeholder="Password">
        <input id="password"  type="password" class="password{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
        @if ($errors->has('password'))
        <span class="invalid-feedback" role="alert">
        <strong>{{ $errors->first('password') }}</strong>
        </span>
        @endif
      </div>
</div>
<div class="remember_me">
    <input class="check_remember" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
    <label class="login_labels" for="remember">
      {{ __('Remember Me') }} 
    </label>
</div>
<div class="submit_forgotpassword">
        <button type="submit" class="submit-btn">
        {{ __('Login') }}
        </button>
</div>

<div class="forgot">
    <a class="forgot-pass" href="{{ route('password.request') }}">
        {{ __('Forgot Your Password?') }}
    </a>
</div>
    </form>
      </div>            
      </div>
      </div>
</div>

@endsection