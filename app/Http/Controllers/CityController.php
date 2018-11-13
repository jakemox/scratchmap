<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use SKAgarwal\GoogleApi\PlacesApi;


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
        $googlePlaces = new PlacesApi(env('MIX_GOOGLE_KEY'));
        $attractions = $googlePlaces->textSearch($city.'+attraction', [
            'type=point_of_interest'
        ])['results'];

        return view('city', compact('attractions', 'city'));

    }
}
