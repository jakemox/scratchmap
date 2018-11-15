@extends('layouts.layout', [
    'image' => 'balloon-cutout',
    'css' => 'plan'
])


@section('content')

<h1>Top attractions in {{$city}}</h1>


@foreach ($attractions as $key => $attraction)
<a href="https://www.google.com/maps/place/?q=place_id:{{ $attraction['place_id'] }}"> {{$attraction['name']}}</a><br>
    
<img src="{{$photos[$key]}}">
Address: {{$attraction['formatted_address']}}<br>
Rating: {{$attraction['rating']}}<hr>
@endforeach
    
</main>

@endsection
