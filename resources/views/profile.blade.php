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
  <div class="progress-pie-chart" data-percent="">
    <div class="ppc-progress">
      <div class="ppc-progress-fill"></div>
    </div>
    <div class="ppc-percents">
      <div class="pcc-percents-wrapper">
        <img src="\img\africa-01.svg" height="150px">
      </div>
    </div>
  </div>
</div>

<div class="asia">
  <h4>Asia: {{$asia}}/47 (<?php echo round(($asia/47)*100, 2) ;?>%)</h4>
  <div class="ppc-progress">
      <div class="ppc-progress-fill"></div>
    </div>
    <div class="ppc-percents">
      <div class="pcc-percents-wrapper">
        <img src="\img\asia-01.svg" height="150px">
      </div>
    </div>
  </div>


<div class="europe">
  <h4>Europe: {{$europe}}/45 (<?php echo round(($europe/45)*100, 2) ;?>%)</h4>
  <div class="ppc-progress">
      <div class="ppc-progress-fill"></div>
    </div>
    <div class="ppc-percents">
      <div class="pcc-percents-wrapper">
        <img src="\img\europe-01.svg" height="150px">
      </div>
    </div>
</div>

<div class="north_america">
  <h4>North America: {{$north_america}}/23 (<?php echo round(($north_america/23)*100, 2) ;?>%)</h4>
  <div class="ppc-progress">
      <div class="ppc-progress-fill"></div>
    </div>
    <div class="ppc-percents">
      <div class="pcc-percents-wrapper">
        <img src="\img\north-america-01.svg" height="150px">
      </div>
    </div>
</div>

<div class="south_america">
  <h4>South America: {{$south_america}}/12 (<?php echo round(($south_america/12)*100, 2) ;?>%)</h4>
  <div class="ppc-progress">
      <div class="ppc-progress-fill"></div>
    </div>
    <div class="ppc-percents">
      <div class="pcc-percents-wrapper">
        <img src="\img\south-america-01.svg" height="150px">
      </div>
    </div>
</div>

<div class="australia">
  <h4>Oceania: {{$australia}}/14 (<?php echo round(($australia/14)*100, 2) ;?>%)</h4>
  <div class="ppc-progress">
      <div class="ppc-progress-fill"></div>
    </div>
    <div class="ppc-percents">
      <div class="pcc-percents-wrapper">
        <img src="\img\oceania-01.svg" height="150px">
      </div>
    </div>
</div> 
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

<script language="JavaScript" type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js">

  let africa =  ({{$africa}}/53)*100;
  let asia =  ({{$asia}}/47)*100;
  let europe =  ({{$europe}}/45)*100;
  let north_america =  ({{$north_america}}/23)*100;
  let south_america =  ({{$south_america}}/12)*100;
  let australia =  ({{$australia}}/14)*100;


  $(function(){
  var $ppc = $('.progress-pie-chart'),
    percent = parseInt(45);
    deg = 360*percent/100;
  if (percent > 50) {
    $ppc.addClass('gt-50');
  }
  $('.ppc-progress-fill').css('transform','rotate('+ deg +'deg)');
  
});


</script>