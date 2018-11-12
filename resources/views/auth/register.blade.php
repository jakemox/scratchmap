@extends('layouts.layout', [
    'image' => 'balloon-cutout',
    'css' => 'plan'
])


@section('content')
<div class="sky">
    <div id="clouds" class="clouds"></div>
    <div id="mountains" class="mountains"></div>
    <div id="trees" class="trees"></div>
    <div id="slope" class="slope"></div>
    <div class="fade">
    <div class="container-form">
            <div class="form">
            <div class="password">
                <form method="POST" action="{{ route('register') }}">
                @csrf
                <label for="name">{{ __('Name') }}</label>

                <div class="name-input">
                    <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>

                    @if ($errors->has('name'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
                </div>
                </div>

                <div class="password">
                    <label for="email">{{ __('E-Mail Address') }}</label>

                    <div class="email-input">
                        <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                        @if ($errors->has('email'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="password">
                    <label for="password">{{ __('Password') }}</label>

                    <div class="password-input">
                        <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                        @if ($errors->has('password'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="password">
                    <label for="password-confirm">{{ __('Confirm Password') }}</label>

                    <div class="confirm-password-input">
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                    </div>
                </div>

                        
                <div class="password">
                    <button type="submit" class="submit-btn">
                        {{ __('Register') }}
                    </button>
                </div>
                        
                </form>
            </div>
            </div>
@endsection
