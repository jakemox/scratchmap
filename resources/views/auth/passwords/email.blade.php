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
        <form class="form" method="POST" action="{{ route('password.email') }}">
            <div class="reset-pass">{{ __('Reset Password') }}</div>
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                {{ session('status') }}EMAIL
                </div>
            @endif 
            @csrf
            <div class="login-field">
                <label for="email" class="login_labels">
                    <img src="\img\email.svg" alt="email_logo">
                </label>
                <input placeholder="E-Mail address" id="email" type="email" class="login-input password{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>
                @if ($errors->has('email'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
            </div>
            <div class="send_pass">
                <button type="submit" class="submit-btn">
                Send Link
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

