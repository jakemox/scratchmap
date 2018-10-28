@extends('layouts.app')

@section('content')

<p>This is the front page. </p>

<p>On a large screen shows map.</p>

<p>On a smaller screen shows a list of countries.</p>

<p>Below list of countries with an option to save visited countries (if logged in).</p>

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
      {{-- Below code for populating the countries where user has visited and an individual form / submit button to save each visited country --}}
      <td>
        @if(isset($user))
          <form action="" method="post">
            @csrf
            <input type="hidden" name="code" value="{{$country->id}}">
              {{-- TO DO:  push the selections to DB without a form --}}
            <?php $has_visited=null; ?>
            @foreach ($visited as $visit)
              @if ($visit->id === $country->id)
                <i class="fas fa-check-circle"></i>
                <?php $has_visited = '1'; ?>
              @endif
            @endforeach
              @if (!isset($has_visited))
                <i class="far fa-circle"></i>
              @endif
            @endif
            <input type="submit" value="<?php
            if ($has_visited) {
              echo "Remove";
            } else echo "Been here!";
            ?>">
          </form>
        </td>
      </tr>
      
      @endforeach
    </table>

</form>

@endsection
