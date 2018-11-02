<div class="container">

<script>
  // AJAX script to insert selection into DB without page refresh
  function toggle_visit(country_id)
  {
    $.ajax({
      url: '/',
      method: 'post',
      data: {
        _token: "{{ csrf_token() }}",
        id: country_id
      }
    });

    let toggle = document.getElementById('country_'+country_id);

    if (toggle.firstElementChild.className == "far fa-circle") {
      toggle.innerHTML = "<i class=\"fas fa-check-circle\"></i>";
    } else {
    toggle.innerHTML = "<i class=\"far fa-circle\"></i>";
    }
  }    

</script>

<ul>
@foreach ($countries as $country)

<li class="list-country-item">
  <div class="image-crop">
    <img src="{{ asset('img/flags-normal/'.strtolower($country->code).'.png') }}" class="flag-icon">
  </div>
  <div class="list-country-name">
    {{$country->name}} 
  </div>
  {{-- Below code for populating the countries where user has visited and a button to change the state. Button is "checked" if country is visited, circle if not (font awesome icons). --}}
  {{-- <div class="country-" id={{$country->id}}> --}}
    {{-- @if(isset($user_id)) --}}
      <?php $has_visited=null; ?>
      @foreach ($visited as $visit)
        @if ($visit->id === $country->id)
          <?php $has_visited = '1'; ?>
        @endif
      @endforeach
  <div id="country_{{$country->id}}" class="country-button" onclick="toggle_visit({{$country->id}})">
    <?php if ($has_visited) {
    echo "<i class=\"fas fa-check-circle\"></i>";
    } else echo "<i class=\"far fa-circle\"></i>";
    ?>  
  </div>
    {{-- @endif --}}
    </li>
  
  @endforeach
  </ul>


</div>
