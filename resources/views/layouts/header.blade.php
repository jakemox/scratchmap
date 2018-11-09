
<header>
  <div class="mobile">
      <img src="\img\{{$image}}.svg" alt="balloon" height="80px" width="80px">
    <a href="index.html"><h1>ScratchMapp</h1></a>
  </div>
  <div class="desktop">
    <div class="column1">
        <a href="/"><h2>Map</h2></a>
        <a href="/search"><h2>Plan</h2></a>
        <div class="log_reg">
                <a href="{{ route('login') }}">{{ __('Login') }}</a><span>|</span>
                <a href="{{ route('register') }}">{{ __('Register') }}</a>
        </div>
    </div>
    <div class="column2">
        <div class="balloon"><img src="\img\{{$image}}.svg" alt="balloon"></div>
        <h1>ScratchMapp</h1>
    </div>
    <div class="column3">
        <h2>Profile</h2>
        <h2>Export</h2>
    </div> 
    <div class="logout">
            <a href="{{ url('/logout') }}"> Logout </a>
    </div>
  </div>  
</header>
