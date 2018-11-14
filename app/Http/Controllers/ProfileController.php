<?php

namespace App\Http\Controllers;
use DB;
use Auth;
use App\User;
use Illuminate\Http\Request;
use App\Country;
class ProfileController extends Controller
{
    public function show() {
        $user_id = Auth::id();
        $user = User::find($user_id);
        $user_score = $user->score;
        $user_name = $user->name;
        
        $europe = $user->countries()->where('CONTINENT', 'Europe')->count();
        $africa = $user->countries()->where('CONTINENT', 'Africa')->count();
        $asia = $user->countries()->where('CONTINENT', 'Asia')->count();
        $north_america = $user->countries()->where('CONTINENT', 'North America')->count();
        $south_america = $user->countries()->where('CONTINENT', 'South America')->count();
        $australia = $user->countries()->where('CONTINENT', 'Oceania')->count();


        $visited_countries = DB::table('user_visited_countries')->where('user_id', $user_id)->get();
        return view('profile',  compact('user_score', 'visited_countries', 'user_name', 'europe', 'africa', 'asia', 'north_america', 'south_america', 'australia'));
    }
}
