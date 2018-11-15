@extends('layouts.layout', [
    'image' => 'balloon-cutout',
    'css' => 'plan'
])


@section('content')

<h1>Top attractions in {{$city_name}}, {{$country[0]->name}}</h1>


@foreach ($attractions as $key => $attraction)
<a href="https://www.google.com/maps/place/?q=place_id:{{ $attraction['place_id'] }}"> {{$attraction['name']}}</a><br>
    
<img src="{{$attraction['photo']}}"><br>
Address: {{$attraction['address']}}<br>
Rating: {{$attraction['rating']}}<hr>
@endforeach
    
</main>

@endsection
