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
        <form class="form" method="POST" action="{{ route('register') }}">
            @csrf
            <div class="login-field">
                <label class="login_labels" for="name">
                    <img src="img\profile-black.svg" alt="email_logo">
                </label>
                {{-- <div class="name-input"> --}}
                    <input placeholder="Name" id="name" type="text" class="login-input form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>
                    @if ($errors->has('name'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
                {{-- </div> --}}
            </div>
            
            <div class="login-field">
                <label class="login_labels" for="email">
                    <img src="img\email.svg" alt="email_logo">
                </label>
                {{-- <div class="email-input"> --}}
                    <input placeholder="E-Mail address" id="email" type="email" class="login-input form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                    @if ($errors->has('email'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                    {{-- </div> --}}
            </div>
            <div class="login-field">
                <label class="login_labels" for="password">
                    <img src="img/padlock.svg" alt="padlock_logo">
                </label>
                {{-- <div class="password-input"> --}}
                    <input placeholder="Password" id="password" type="password" class="login-input form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                    @if ($errors->has('password'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                {{-- </div> --}}
            </div>
            <div class="login-field">
                <label class="login_labels" for="password-confirm">
                    <img src="img/padlock-tick.svg" alt="padlock_logo">
                </label>
                <div class="confirm-password-input">
                    <input placeholder="Confirm password" id="password-confirm" type="password" class="login-input form-control" name="password_confirmation" required>
                </div>
            </div>
            <div class="submit_forgotpassword">
                <button type="submit" class="submit-btn">
                    {{ __('Register') }}
                </button>
            </div>
        </form>
    </div>          
</div>          
           
@endsection
