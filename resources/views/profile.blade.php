@extends('layouts.layout', [
    'image' => 'balloon',
    'css' => 'app'
])

@section('content')

<link href="css-circular-prog-bar.css" rel="stylesheet">

<div class="profile">
      <h2>{{$user_name}}</h2>
      <h3>Score: {{$user_score}}</h3>
      <h3>Statistics</h3>
  <h3>Visited countries: {{count($visited_countries)}}</h3>
  <div class="africa">
  <h4>Africa: {{$africa}}/53 (<?php echo round(($africa/53)*100, 2) ;?>%)</h4>
  <div class="box">
      <div class="progress" id="progress">
        <div class="inner">
          africa
        </div>
      </div>
    </div>
    
  </div>
  <h4>Asia: {{$asia}}/47 (<?php echo round(($asia/47)*100, 2) ;?>%)</h4>
  <h4>Europe: {{$europe}}/45 (<?php echo round(($europe/45)*100, 2) ;?>%)</h4>
  <h4>North America: {{$north_america}}/23 (<?php echo round(($north_america/23)*100, 2) ;?>%)</h4>
  <h4>South America: {{$south_america}}/12 (<?php echo round(($south_america/12)*100, 2) ;?>%)</h4>
  <h4>Oceania: {{$australia}}/14 (<?php echo round(($australia/14)*100, 2) ;?>%)</h4>
  
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
</div>

@endsection

<script type="text/javascript">
  let africa =  ({{$africa}}/53)*100;
  let asia =  ({{$asia}}/47)*100;
  let europe =  ({{$europe}}/45)*100;
  let north_america =  ({{$north_america}}/23)*100;
  let south_america =  ({{$south_america}}/12)*100;
  let australia =  ({{$australia}}/14)*100;

</script>