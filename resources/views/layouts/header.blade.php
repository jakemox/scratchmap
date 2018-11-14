
<header>
  <div class="mobile">
      <img src="\img\{{$image}}.svg" alt="balloon" height="80px" width="80px">
    <a href="index.html"><h1>ScratchMapp</h1></a>
  </div>
  <div class="desktop">
    <div class="column1">
        <a href="/"><h2>Map</h2></a>
        <a href="/search"><h2>Plan</h2></a>
        @guest
        <div class="log_reg">
                <a href="{{ route('register') }}">{{ __('Register') }}</a>
        </div>
        @endguest
    </div>
    <div class="column2">
        <div class="balloon"><img src="\img\{{$image}}.svg" alt="balloon"></div>
        <h1>ScratchMapp</h1>
    </div>
    <div class="column3">
        @auth
        <a href="/profile"><h2>Profile</h2></a>
        @endauth
        @guest
    <a href="{{ route('login') }}"><h2>Login</h2></a>
        @endguest
    @auth
    <a href="{{ url('/logout') }}"><h2>Logout</h2></a>
    @endauth
        
    </div> 
  </div>  
</header>
