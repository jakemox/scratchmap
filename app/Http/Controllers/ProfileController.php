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
        

        $visited_countries = DB::table('user_visited_countries')->where('user_id', $user_id)->get();
    // dd(DB::table('user_visited_countries')->where('user_id', $user_id)->get());
        return view('profile',  compact('user_score', 'visited_countries', 'user_name'));
    }
}
