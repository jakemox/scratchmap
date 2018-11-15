<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\City;
use App\Attraction;

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


    public function show($city) {
        
        $attractions = Attraction::where('city_name', $city)->where('photo', '!=', '')->orderBy('rating', 'DESC')->limit(5)->get();
        
        return view('city', compact('attractions', 'city'));

    }

    public function api($city) {
        // API call to save results of "top attractions in a city" from Google Places API to a local file.
        $city = Attraction::where('city_name', $city)->get();
        return $city;

        // axios.get()

    }
}
