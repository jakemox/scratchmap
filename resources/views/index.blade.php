@extends('layouts.app')

@section('content')

<p>This is the front page. </p>

<p>On a large screen shows map.</p>

<p>On a smaller screen shows a list of countries.</p>

<p>Below list of countries with an option to save visited countries (if logged in).</p>

<script>
  // AJAX script to insert selection into DB without page refresh
  function toggle_visit(country_id)
  {
    $.ajax({
      url: '/',
      method: 'post',
      data: {
        _token: "{{ csrf_token() }}",
        code: country_id
      }
    });

    let toggle = document.getElementById('country_'+country_id);

    if (toggle.firstChild.className == "far fa-circle") {
      toggle.innerHTML = "<i class=\"fas fa-check-circle\"></i>";
    } else {
    toggle.innerHTML = "<i class=\"far fa-circle\"></i>";
    }
  }    
</script>

<?php $user = App\User::find($user_id) ?>
<table>
  <tr>
    <td><b>Code</b></td>
    <td><b>Country name</b></td>
    <td><b>
      @if(isset($user))
      Been there?</b></td>
      @endif
    </tr>
    
    @foreach ($countries as $country)
    
    <tr class="country_list">
      <td>{{$country->code}} </td>
      <td>{{$country->name}} </td>
      {{-- Below code for populating the countries where user has visited and an individual form / submit button to save each visited country. Submit button is "checked" if country is visited, circle if not (font awesome icons). --}}
      <td>
        @if(isset($user))
              {{-- TO DO:  push the selections to DB without a form --}}
            <?php $has_visited=null; ?>
            @foreach ($visited as $visit)
              @if ($visit->id === $country->id)
                <?php $has_visited = '1'; ?>
              @endif
            @endforeach
          <div id="country_{{$country->id}}" class="country_button" onclick="toggle_visit({{$country->id}})">
                  <?php
                  if ($has_visited) {
                    echo "<i class=\"fas fa-check-circle\"></i>";
                  } else echo "<i class=\"far fa-circle\"></i>";
                ?>  
              </div>
        @endif
        </td>
      </tr>
      
      @endforeach
    </table>

</form>

@endsection
