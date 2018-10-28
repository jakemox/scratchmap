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
        $country_id = $country[0]->id;
        $user_id = Auth::id();

        // Validate if user has already visited this country
        $has_visited_query = DB::select(
            "SELECT * FROM `user_visited_countries` 
            WHERE `user_id` = :user_id 
                AND `country_id` = :country_id", 
            ['user_id' => $user_id, 'country_id' => $country_id]
        );

        $has_visited = null;
        if ($has_visited_query != []) {
            $has_visited = 1;
        } 

        // dd($has_visited);

        if($has_visited === null)
        { 
            // If user did not visit country, insert new record in user_visited_countries table
                        
            $query = "
            INSERT INTO `user_visited_countries`(`user_id`, `country_id`)
                VALUES (?,?)
            ";

            DB::insert($query, [$user_id, $country_id]);
            return redirect()->route('list');
        } 
        
        else {
        // If user did visit country, remove existing entry
            $query = "
            DELETE FROM `user_visited_countries`
            WHERE `country_id` = ?
            ";

            DB::delete($query, [$country_id]);
            return redirect()->route('list');
        }


    }
    
}
