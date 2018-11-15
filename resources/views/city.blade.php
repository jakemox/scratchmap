@extends('layouts.layout', [
    'image' => 'balloon',
    'css' => 'app'
])


@section('content')

<h1>Top attractions in {{$city}}</h1>


@foreach ($attractions as $key => $attraction)
<a href="https://www.google.com/maps/place/?q=place_id:{{ $attraction['place_id'] }}"> {{$attraction['name']}}</a><br>
    
<img src="{{$attraction['photo']}}"><br>
Address: {{$attraction['address']}}<br>
Rating: {{$attraction['rating']}}<hr>
@endforeach
    
</main>

@endsection
