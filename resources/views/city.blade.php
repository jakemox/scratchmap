@extends('layouts.layout', [
    'image' => 'balloon-cutout',
    'css' => 'city'
])


@section('content')

<div id="app-city"></div>

<div class="header-background" style="background-image: url('{{$city[0]->photo}}')">
    <div class="fade">
        <div class="name">
            <h3>{{$city_name}}</h3>
            <h4>{{$country[0]->name}}</h4>
        </div>
    </div>
</div>

<div class="attractions">
    <h1>Top attractions in {{$city_name}}, {{$country[0]->name}}</h1>
    
    
    @foreach ($attractions as $key => $attraction)
    <a href="https://www.google.com/maps/place/?q=place_id:{{ $attraction['place_id'] }}"> {{$attraction['name']}}</a><br>
        
    <img src="{{$attraction['photo']}}"><br>
    Address: {{$attraction['address']}}<br>
    Rating: {{$attraction['rating']}}<hr>
    @endforeach
</div>
    


@endsection
