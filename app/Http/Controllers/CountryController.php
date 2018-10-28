<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Country;
use Auth;
use App\User;
use DB;

class CountryController extends Controller
{
    public function index()
    {    
        $countries = Country::orderBy('name')->get();

        $user_id = Auth::id();
        $user = User::find($user_id);

        $visited = '';
        if($user) 
        {
            $visited = $user->countries;
        }

        return view('/index', compact('countries', 'user_id','visited'));
        
    }

    public function store(Request $country_id) {

        $country = Country::find($country_id);
        // dd($country[0]->id);

        $query = "
        INSERT INTO `user_visited_countries`(`user_id`, `country_id`)
            VALUES (?,?)
        ";

        DB::insert($query, [Auth::id(), $country[0]->id]);
        return redirect()->route('list');

    }
    
}
