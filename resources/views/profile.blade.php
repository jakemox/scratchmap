@extends('layouts.layout', [
    'image' => 'balloon',
    'css' => 'app'
])


@section('content')


<div class="profile">
  <aside class="aside">
      <h2>{{$user_name}}</h2>
  <h3>Score: {{$user_score}}</h3>
  <h3>Visited countries: {{count($visited_countries)}}</h3>
  @foreach ($visited_countries as $item)
  <div class="country-list">
    <div class="image-crop">
        <img class="flag-icon" src="img/flags-normal/{{\App\Country::find($item->country_id)->code}}.png" alt="{{\App\Country::find($item->country_id)->code}}">
    </div>
    <div class="list-country-name">
        {{\App\Country::find($item->country_id)->name}}
    </div>
    </div> 
  @endforeach
  </aside>
</div>

@endsection


