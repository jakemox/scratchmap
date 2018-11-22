@extends('layouts.layout', [
    'image' => 'balloon-cutout',
    'css' => 'plan'
])

@section('content')



<div class="profile">
  <div class="fade">
    <div class="outer">
    <div class="profile-thing">
        @if (count($errors) > 0)
          <div class="alert alert-danger">
              <strong>Whoops!</strong> There were some problems with your input.<br><br>
          </div>
        @endif
        <div class="profile_name">
          <h2>{{$user_name}}'s Profile</h2>
        </div>
        <div class="scoreandimage">
        <div class="score_container">
        <div class="score">
          <div class="progress-pie-chart" data-visited="{{count($visited_countries)}}" data-total-countries="198">
            <div class="ppc-progress">
              <div class="ppc-progress-fill"></div>
            </div>
            <div class="ppc-percents">
              <div class="pcc-percents-wrapper">
                <img src="\img\worldg.png" height="160px">
              </div>
            </div>
          </div>
          {{count($visited_countries)}}/198
          <h3>Visited countries: <span>{{count($visited_countries)}}</span></h3>
        </div>
        </div>
        <div class="profile_image">
          <div class="photo-photo">
          <div class="image-crop2">
            @if ($user->avatar)
              <img class="rounded-circle" src="/storage/avatars/{{ $user->avatar }}"/>
            @else 
            <img class="rounded-circle" src="/img/user.svg"/>
            @endif
          </div>
          </div>
            <div class="photo-form">
            <form action="{{action('ProfileController@update_avatar')}}" method="post" enctype="multipart/form-data">
              @csrf
              <div class="form-group">
                    <input type="file" class="form-control-file" name="avatar" id="avatarFile" aria-describedby="fileHelp">
                    <div class="upload-btn" onclick="document.getElementById('avatarFile').click()">Choose file</div>
                    <small id="fileHelp" class="form-text text-muted">Max 2MB.</small>
                  <button type="submit" class="score score-btn" id="score-btn">Submit</button>
                  <div class="score-button" onclick="document.getElementById('score-btn').click()">Submit</div>
              </div>
             
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
                    <img src="\img\africa.png" height="160px">
                  </div>
                </div>
              </div>
              {{$africa}}/53
            </div>
            
            <div class="asia">
                <div class="progress-pie-chart" data-visited="{{$asia}}" data-total-countries="47">
                    <div class="ppc-progress">
                      <div class="ppc-progress-fill"></div>
                    </div>
                    <div class="ppc-percents">
                      <div class="pcc-percents-wrapper">
                        <img src="\img\asia.png" height="160px">
                      </div>
                    </div>
                  </div>
                  {{$asia}}/47
              </div>
            
            
            <div class="europe">
                <div class="progress-pie-chart" data-visited="{{$europe}}" data-total-countries="45">
                    <div class="ppc-progress">
                      <div class="ppc-progress-fill"></div>
                    </div>
                    <div class="ppc-percents">
                      <div class="pcc-percents-wrapper">
                        <img src="\img\europe.png" height="160px">
                      </div>
                    </div>
                  </div>
                  {{$europe}}/45
            </div>
            
            <div class="north_america">
                <div class="progress-pie-chart" data-visited="{{$north_america}}" data-total-countries="23">
                    <div class="ppc-progress">
                      <div class="ppc-progress-fill"></div>
                    </div>
                    <div class="ppc-percents">
                      <div class="pcc-percents-wrapper">
                        <img src="\img\north-america.png" height="160px">
                      </div>
                    </div>
                  </div>
                  {{$north_america}}/23
            </div>
            
            <div class="south_america">
                <div class="progress-pie-chart" data-visited="{{$south_america}}" data-total-countries="12">
                    <div class="ppc-progress">
                      <div class="ppc-progress-fill"></div>
                    </div>
                    <div class="ppc-percents">
                      <div class="pcc-percents-wrapper">
                        <img src="\img\south-america.png" height="160px">
                      </div>
                    </div>
                  </div>
                  {{$south_america}}/12
            </div>
            
            <div class="australia">
                <div class="progress-pie-chart" data-visited="{{$australia}}" data-total-countries="14">
                    <div class="ppc-progress">
                      <div class="ppc-progress-fill"></div>
                    </div>
                    <div class="ppc-percents">
                      <div class="pcc-percents-wrapper">
                        <img src="\img\oceania.png" height="160px">
                      </div>
                    </div>
                  </div>
                  {{$australia}}/14
            </div> 
  
      </div>
      
    <div class="visited_list">
      <h3>Countries visited:</h3>
      @foreach ($visited_countries as $item)
      <div class="country-list">  
        <div class="image-crop1">
            <img class="flag-icon" src="img/flags-normal/{{strtolower(\App\Country::find($item->country_id)->code)}}.png" alt="{{\App\Country::find($item->country_id)->code}}">
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



