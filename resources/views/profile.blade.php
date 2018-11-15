@extends('layouts.layout', [
    'image' => 'balloon-cutout',
    'css' => 'plan'
])

@section('content')



<div class="profile">
  <div class="fade">
    <div class="outer">
    <div class="form">
      <div class="profile_details">
        <div class="details">
          <h2>{{$user_name}}</h2>
          <h3>Score: {{$user_score}}</h3>
          <h3>Statistics</h3>
          <h3>Visited countries: {{count($visited_countries)}}</h3>
          <h4>Africa: {{$africa}}/53</h4>
          <h4>Asia: {{$asia}}/47</h4>
          <h4>Europe: {{$europe}}/45</h4>
          <h4>North America: {{$north_america}}/23 </h4>
          <h4>South America: {{$south_america}}/12 </h4>
          <h4>Oceania: {{$australia}}/14 </h4>
        </div>
        <div class="profile_image">
          <div class="photo-photo">
          @if (count($errors) > 0)
              <div class="alert alert-danger">
                  <strong>Whoops!</strong> There were some problems with your input.<br><br>
              </div>
          @endif
          <img class="rounded-circle" src="/storage/avatars/{{ $user->avatar }}"/>
          </div>
            <div class="photo-form">
            <form action="{{action('ProfileController@update_avatar')}}" method="post" enctype="multipart/form-data">
              @csrf
              <div class="form-group">
                  <input type="file" class="form-control-file" name="avatar" id="avatarFile" aria-describedby="fileHelp">
                  <small id="fileHelp" class="form-text text-muted">Size of image should not be more than 2MB.</small>
              </div>
             <button type="submit" class="score">Submit</button>
          </form>
          </div>
        </div>
      </div>
      <div class="continents-profile">
          <div class="africa">
          <div class="progress-pie-chart" data-visited="{{$africa}}" data-total-countries="53">
                <div class="ppc-progress">
                  <div class="ppc-progress-fill"></div>
                </div>
                <div class="ppc-percents">
                  <div class="pcc-percents-wrapper">
                    <img src="\img\africa-01.svg" height="120px">
                  </div>
                </div>
              </div>
              (<?php echo round(($africa/53)*100) ;?>%)
            </div>
            
            <div class="asia">
                <div class="progress-pie-chart" data-visited="{{$asia}}" data-total-countries="47">
                    <div class="ppc-progress">
                      <div class="ppc-progress-fill"></div>
                    </div>
                    <div class="ppc-percents">
                      <div class="pcc-percents-wrapper">
                        <img src="\img\asia-01.svg" height="120px">
                      </div>
                    </div>
                  </div>
                  (<?php echo round(($asia/47)*100) ;?>%)
              </div>
            
            
            <div class="europe">
                <div class="progress-pie-chart" data-visited="{{$europe}}" data-total-countries="45">
                    <div class="ppc-progress">
                      <div class="ppc-progress-fill"></div>
                    </div>
                    <div class="ppc-percents">
                      <div class="pcc-percents-wrapper">
                        <img src="\img\europe-01.svg" height="120px">
                      </div>
                    </div>
                  </div>
                  (<?php echo round(($europe/45)*100) ;?>%)
            </div>
            
            <div class="north_america">
                <div class="progress-pie-chart" data-visited="{{$north_america}}" data-total-countries="23">
                    <div class="ppc-progress">
                      <div class="ppc-progress-fill"></div>
                    </div>
                    <div class="ppc-percents">
                      <div class="pcc-percents-wrapper">
                        <img src="\img\north-america-01.svg" height="120px">
                      </div>
                    </div>
                  </div>
                  (<?php echo round(($north_america/23)*100) ;?>%)
            </div>
            
            <div class="south_america">
                <div class="progress-pie-chart" data-visited="{{$south_america}}" data-total-countries="12">
                    <div class="ppc-progress">
                      <div class="ppc-progress-fill"></div>
                    </div>
                    <div class="ppc-percents">
                      <div class="pcc-percents-wrapper">
                        <img src="\img\south-america-01.svg" height="120px">
                      </div>
                    </div>
                  </div>
                  (<?php echo round(($south_america/12)*100) ;?>%)
            </div>
            
            <div class="australia">
                <div class="progress-pie-chart" data-visited="{{$australia}}" data-total-countries="14">
                    <div class="ppc-progress">
                      <div class="ppc-progress-fill"></div>
                    </div>
                    <div class="ppc-percents">
                      <div class="pcc-percents-wrapper">
                        <img src="\img\oceania-01.svg" height="120px">
                      </div>
                    </div>
                  </div>
                  (<?php echo round(($australia/14)*100) ;?>%)
            </div> 
  
      </div>
      
    <div class="visited_list">
      <h3>So far you have visited:</h3>
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
  </div>
  </div>
  </div>
</div>


<script language="JavaScript" type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script>

   function previewFile(){
       var preview = document.querySelector('img'); //selects the query named img
       var file    = document.querySelector('input[type=file]').files[0]; //sames as here
       var reader  = new FileReader();

       reader.onloadend = function () {
           preview.src = reader.result;
       }

       if (file) {
           reader.readAsDataURL(file); //reads the data as a URL
       } else {
           preview.src = "";
       }
  }

  // previewFile();  //calls the function named previewFile()
  



const elements = document.querySelectorAll('.progress-pie-chart');
  Array.from(elements).forEach(function(progressBarChart){
    let visitedCountries = parseInt(progressBarChart.dataset.visited);
    let totalCountries = parseInt(progressBarChart.dataset.totalCountries);
    let percentage = (visitedCountries/totalCountries)*100;
    let deg = (360*(percentage))/100;
    let progressFillElement = progressBarChart.querySelector('.ppc-progress-fill');
    progressFillElement.style.transform = 'rotate('+deg + 'deg)';
 
});


</script>

@endsection

