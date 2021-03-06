@extends('layouts.layout', [
    'image' => 'balloon-cutout',
    'css' => 'plan',
    'map' => 'map',
    'search' => 'search-grey',
    'profile' => 'profile-grey',
    'logout' => 'logout-grey',
    'padlock' => 'padlock-grey',
    'login' => 'login-grey',
    'git' => 'github-grey'
])

@section('content')

<div class="background">
  <div class="fade">
   
      
        
            <form class="form" id="login-form" method="POST" action="{{ route('login') }}">
            @csrf
            <div class="login-field">
              <label for="email" class="login_labels">
                <img src="img\email.svg" alt="email_logo">
              </label>
              <input id="email" placeholder="E-Mail address" type="email" class="login-input email_input{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>
              @if ($errors->has('email'))
              <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('email') }}</strong>
              </span>
              @endif
            </div>
           
            <div class="login-field">
              <label for="password" class="login_labels">
                <img src="img/padlock.svg" alt="padlock_logo">
              </label>
              <div class="password">
                <input id="password" placeholder="Password" type="password" class="login-input password{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
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

@endsection