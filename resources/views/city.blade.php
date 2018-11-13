@extends('layouts.layout', [
    'image' => 'balloon',
    'css' => 'app'
])


@section('content')

<h1>Top attractions in {{$city}}</h1>

@foreach ($attractions as $key => $attraction)
Name: {{$attraction['name']}}<br>    
Address: {{$attraction['formatted_address']}}<br>
Rating: {{$attraction['rating']}}<hr>
@endforeach
    
</main>

@endsection
