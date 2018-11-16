<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Country;
use Auth;
use App\User;
use DB;

class CountryController extends Controller
{
    public function index(Request $request)
    {
        
        $user_id = Auth::id();
        // fwrite($fp, $user_id."\n");

        $user = Auth::user();
        
        if(Auth::check() && $request->session()->has('countries')){
            $countries = $request->session()->get('countries');

            foreach($countries as $country)
            {
            
                $has_visited_query = DB::select(
                    "SELECT * FROM `user_visited_countries` 
                    WHERE `user_id` = :user_id 
                        AND `country_id` = :country_id", 
                    ['user_id' => $user_id, 'country_id' => $country]
                );
        
                $has_visited = null;
                if ($has_visited_query != []) {
                    $has_visited = 1;   
                } 
        
        
                if($has_visited === null)
                { 
                    // If user did not visit country, insert new record in user_visited_countries table
                    $user->score = $user->score + 100;
                    $user->save();
                       
                    $query = "
                    INSERT INTO `user_visited_countries`(`user_id`, `country_id`)
                        VALUES (?,?)
                    ";
        
                    DB::insert($query, [$user_id, $country]);
                } 
            }
            $request->session()->forget('countries');
            
        }

        $countries = Country::orderBy('id')->get();
        // $fp = fopen('/tmp/debug.txt', 'a');


        
    
        $visited_countries = DB::select(
            "SELECT `country_id` FROM `user_visited_countries` 
            WHERE `user_id` = :user_id", 
            ['user_id' => $user_id]
        );
        

        $user = User::find($user_id);
        $visited = '';
        if($user) 
        {
            $visited = $user->countries;
        }

        // DB::table('user_visited_countries')->where('user_id', $user_id);
        return view('index',compact('visited_countries','countries','user_id','visited'));
    }

    public function store(Request $request) {
        $country_id = $request->id;

        if(!Auth::check()){
            if(!$request->session()->has('countries')){
                $request->session()->put('countries', []);
            }

            $countries = $request->session()->get('countries');
            if(in_array($country_id, $countries)){
                $i = array_search($country_id, $countries);
                unset($countries[$i]);
                $request->session()->put('countries', $countries);
            }else{
                $request->session()->push('countries', $country_id);
            }

            

            return $request->session()->get('countries');


        }

        $country = Country::find($country_id);

        $user_id = Auth::id();

        $user = Auth::user();
      

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


        if($has_visited === null)
        { 
            // If user did not visit country, insert new record in user_visited_countries table
            $user->score = $user->score + 100;
            $user->save();
               
            $query = "
            INSERT INTO `user_visited_countries`(`user_id`, `country_id`)
                VALUES (?,?)
            ";

            DB::insert($query, [$user_id, $country_id]);
        } 
        
        else {
        // If user did visit country, remove existing entry
            $query = "
            DELETE FROM `user_visited_countries`
            WHERE `country_id` = ?
            ";

            $user->score = $user->score - 100;
            $user->save();
    

            DB::delete($query, [$country_id]);
        }
    }

    public function show($id) {
        $country = Country::find($id);
        return $country;
    }

        public function list() {
        $countries = Country::get();
        return $countries;
    }
    
    public function visits() {
        $user_id = Auth::id();
        $visited_countries = DB::select(
            "SELECT `country_id` FROM `user_visited_countries` 
            WHERE `user_id` = :user_id 
            ORDER BY `country_id` ASC", 
            ['user_id' => $user_id]
        );

        return $visited_countries;
    }


}

