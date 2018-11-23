@extends('layouts.layout', [
    'image' => 'balloon-cutout',
    'css' => 'app',
    'js' => 'mapbox',
    'map' => 'map-light',
    'search' => 'search',
    'profile' => 'profile',
    'logout' => 'logout',
    'padlock' => 'padlock-light',
    'login' => 'login',
    'git' => 'github-light'
])


@section('content')
 
<main>
    <div class="loading" id="loading">
        <div class="spinner">
            <img class="bounce" src="\img\balloon.svg" alt="balloon" height="80px" width="80px">
            <h1 class="loading_title">Scratchmapp<h1><br>
            @auth
            <h2 class="loading_welcome">Welcome back,<br> {{ Auth::user()->name }}</h2>
            @endauth
        </div>
    </div>
    
    <div class="sea">
        <div class='map' id='map'>
            <div id="score-container"></div>
            <a href="#">
                <div id="trigger-mobile"  class='listview-mobile'>View as List</div>
            </a> 
            <a href="#">
                <div id="trigger-desktop" class='listview-desktop'>View as List</div>
            </a>
            <div id="slider" class="slider close">
                @include('list')
            </div>    
        </div>
    </div>

    <div class='features' id='features'>
        <div class="instructions">
            <img src="img/balloon-red.svg" alt="">
            <h6>Welcome to ScratchMapp!</h6>
            <p>Click on the countries you have visited.</p>
            <p>Sign in or Register to save progress</p>
        </div>
    </div>
  
</main>
{{-- <script>
    window.userId = '{{ Auth::id() }}';
</script> --}}

@endsection

