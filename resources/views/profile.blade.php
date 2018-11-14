@extends('layouts.layout', [
    'image' => 'balloon',
    'css' => 'app'
])


@section('content')


<div class="profile">
  <aside class="aside">
      <h2>{{$user_name}}</h2>
      <h3>Score: {{$user_score}}</h3>
      <h3>Statistics</h3>
  <h3>Visited countries: {{count($visited_countries)}}</h3>
  <h4>Africa: {{$africa}} (<?php echo round(($africa/53)*100, 2) ;?>%)</h4>
  <h4>Asia: {{$asia}} (<?php echo round(($asia/47)*100, 2) ;?>%)</h4>
  <h4>Europe: {{$europe}} (<?php echo round(($europe/45)*100, 2) ;?>%)</h4>
  <h4>North America: {{$north_america}} (<?php echo round(($north_america/23)*100, 2) ;?>%)</h4>
  <h4>South America: {{$south_america}} (<?php echo round(($south_america/12)*100, 2) ;?>%)</h4>
  <h4>Oceania: {{$australia}} (<?php echo round(($australia/14)*100, 2) ;?>%)</h4>
  
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


