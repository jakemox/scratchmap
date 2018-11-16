<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\City;
use App\Attraction;
use App\Country;

class CityController extends Controller
{
    public function index($city)
    {
        var_dump('hello');
    }

    public function search(Request $request)
    {   
        $params = $request->all();
        return redirect('/city/' . $params['search']);

    }


    public function show($city_name) {
        
        $city = City::where('name', $city_name)->get();

        //filtering out attractions with no pictures and with rating 5.0 to get rid of obscure entities
        $attractions = Attraction::where('city_name', $city_name)->where('photo', '!=', '')->where('rating', '<', 5)->orderBy('rating', 'DESC')->limit(5)->get();
        
        $country = Country::where('code' , '=', $city[0]->country_code)->get();
        
        return view('city', compact('attractions', 'city_name', 'country', 'city'));

    }

    public function api($city_name) {
        //filtering out attractions with no pictures and with rating 5.0 to get rid of obscure entities
        $attractions = Attraction::where('city_name', $city_name)->where('photo', '!=', '')->where('rating', '<', 5)->orderBy('rating', 'DESC')->limit(5)->get();
        
        return compact('attractions');

    }
}
