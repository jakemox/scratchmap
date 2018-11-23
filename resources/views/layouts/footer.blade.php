<footer>
  <nav>
    <a href="/"><img src="/img/{{$map}}.svg" alt="homepage" height="40px" width="40px"></a>
    <a href="/search"><img src="/img/{{$search}}.svg" alt="list_of_countries" height="40px" width="40px"></a>
    @auth
    <a href="/profile"><img src="/img/{{$profile}}.svg" alt="profile" height="40px" width="40px"></a>
    <a href="{{ url('/logout') }}"><img src="/img/{{$logout}}.svg" alt="logout" height="40px" width="40px"></a>
    @endauth
    @guest
    <a href="/register"><img src="/img/{{$padlock}}.svg" alt="register" height="40px" width="40px"></a>
    <a href="/login"><img src="/img/{{$login}}.svg" alt="logout" height="40px" width="40px"></a>
    @endguest
  </nav>
</footer>



