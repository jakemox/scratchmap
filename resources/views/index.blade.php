@extends('layouts.layout', [
    'image' => 'balloon-cutout',
    'css' => 'app'
])


@section('content')
 
<main>
    <div class="loading" id="loading">
        <div class="spinner">
            <img class="bounce" src="\img\balloon.svg" alt="balloon" height="80px" width="80px">
            <h1 class="loading_title">Scratchmapp<h1><br><br>
            @auth
            <h2 class="loading_welcome">Welcome back, {{ Auth::user()->name }}</h2>
            @endauth
        </div>
    </div>
    <div id="score-container"></div>
    <div class="sea">
        <div class='map' id='map'>
            
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
            
    </div>
  
</main>
{{-- <script>
    window.userId = '{{ Auth::id() }}';
</script> --}}

@endsection




