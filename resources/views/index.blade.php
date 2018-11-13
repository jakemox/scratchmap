@extends('layouts.layout', [
    'image' => 'balloon',
    'css' => 'app'
])


@section('content')

<main>
    <div class="sea">
        <div class='map' id='map'>
            <div id="score-container"></div>
             <a href="#"><div id="trigger-mobile"  class='listview-mobile'>View as List</div></a> 
             <a href="#"><div id="trigger-desktop" class='listview-desktop'>View as List</div></a>
             <div id="slider" class="slider close">
            @include('list')

            </div>    
        </div>
    </div>
   
    <div class='features' id='features'></div>
    
</main>

@endsection
