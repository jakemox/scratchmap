@extends('layouts.app')

@section('content')

<p>This is the front page. </p>

<p>On a large screen shows map.</p>

<p>On a smaller screen shows a list of countries.</p>

<p>Below list of countries with an option to save visited countries (if logged in).</p>

<form action="" method="post">
    <table>
      <tr>
        <td><b>Code</b></td>
        <td><b>Country name</b></td>
        <td><b>Been there?</b></td>
      </tr>
      <?php $user = App\User::find($user_id) ?>
      {{$user}}

      {{$visited}}
      
      @foreach ($countries as $country)
      
      <tr>
        <td>{{$country->code}} </td>
        <td>{{$country->name}} </td>
        <td>
          {{-- TO DO:  display the countries that the signed in user has visited + push the selections to DB without a form --}}
          Dont know</td>
      </tr>
      
      @endforeach
    </table>

</form>

@endsection
