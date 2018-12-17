
<header>
  <div class="mobile">
    <a href="{{ route('home') }}"><img src="\img\{{$image}}.svg" alt="balloon" height="80px" width="80px"></a>
    <h1>ScratchMyApp</h1>
  </div>
  <div class="desktop">
    <div class="column1">
        <a href="/"><h2>Map</h2></a>
        <a href="/search"><h2>Search</h2></a>
    </div>
    <div class="column2">
        <div class="balloon"><img src="\img\{{$image}}.svg" alt="balloon"></div>
        <h1>ScratchMyApp</h1>
    </div>
    <div class="column3">
    @auth
        <a href="/profile"><h2>Profile</h2></a>
    @endauth
    @guest
        <a href="{{ route('register') }}"><h2>{{ __('Register') }}</h2></a>
    @endguest
    @guest
        <a href="{{ route('login') }}"><h2>Login</h2></a>
    @endguest
    @auth
        <a href="{{ url('/logout') }}"><h2>Logout</h2></a>
    @endauth
        
    </div> 
    <div class="about">
        <a target="_blank" href="https://github.com/jakemox/scratchmap">About Scratchmapp
        <i class="fab fa-github"></i>
        </a>
    </div>
</div>  
</header>
