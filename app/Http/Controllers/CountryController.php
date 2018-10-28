<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Country;
use Auth;
use App\User;

class CountryController extends Controller
{
    public function index()
    {    
        $countries = Country::get();

        $user_id = Auth::id();
        $user = User::find($user_id);

        $visited = $user->countries;


        return view('/index', compact('countries', 'user_id','visited'));
        
    }
    
}
