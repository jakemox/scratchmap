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
        <form id="search-form" action="">
            <label id="search-label" for="search"><img src="\img\search.svg" alt=""></label>
            <input id="search-input" name="search" type="text" placeholder="Search Destinations">
        </form>
    </div>
</div>

<script src=""></script>


@endsection