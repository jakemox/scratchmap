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
        <form class="search-form" method="post" id="search-form" action="/city/search">
            {{csrf_field()}}
            <div class="form-group">
                <label id="search-label" for="search">
                    <img src="\img\search.svg" alt="">
                </label>
                <input autocomplete="off" id="search-input" name="search" type="text" placeholder="Search destinations">
                <button type="submit">Search</button>
            </div>
        </form>
    </div>
</div>

<script src=""></script>


@endsection