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
<div class="container">
    <div class="form">
    <div class="reset-pass">{{ __('Reset Password') }}</div>
        <div class="password">
            @if (session('status'))
            <div class="alert alert-success" role="alert">
            {{ session('status') }}EMAIL
            </div>
            @endif  
            <form method="POST" action="{{ route('password.email') }}">
            @csrf
                <div class="email-123">
                    <label for="email" class="email-address">{{ __('E-Mail Address') }}</label>
                </div>
                <div>
                    <input id="email" type="email" class="password{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>
                    @if ($errors->has('email'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                    @endif
                </div>
       
        </form>
        </div>
        <div class="send_pass">
                <button type="submit" class="submit-btn">
                {{ __('Send Password Reset Link') }}
                </button>
        </div>
    
</div>
</div>
@endsection

