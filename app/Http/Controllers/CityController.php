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
        $photos = [];
        foreach ($attractions as $key => $value) {
            if(isset($value['photos']))
            {
                // dd($value['photos'][0]['photo_reference']);
                $photos[] = $googlePlaces->photo($value['photos'][0]['photo_reference'],['maxwidth' => 500]);
            } else {
                $photos[]="";
                }
        }

        return (compact('attractions', 'city', 'photos'));

    }

    public function cache($city) {
        // API call to save results of "top attractions in a city" from Google Places API to a local file.

        $cache = __DIR__."/attractions.json";

        $googlePlaces = new PlacesApi(env('MIX_GOOGLE_KEY'));
        $attractions = $googlePlaces->textSearch($city.'+attraction', [
            'type=point_of_interest'
        ])['results'];
        $photos = [];
        foreach ($attractions as $key => $value) {
            if(isset($value['photos']))
            {
                // dd($value['photos'][0]['photo_reference']);
                $photos[] = $googlePlaces->photo($value['photos'][0]['photo_reference'],['maxwidth' => 500]);
            } else {
                $photos[]="";
            }
        }

        $handle = fopen($cache, 'wb') or die('no fopen');
        $json_cache = $attractions;
        fwrite($handle, $json_cache);
        fclose($handle);

        var_dump(__DIR__);
        var_dump($cache);

    }
}
