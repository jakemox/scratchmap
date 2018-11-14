<?php 
// API call to save results of "top attractions in a city" from Google Places API to a local file.

use SKAgarwal\GoogleApi\PlacesApi;

$city = "Helsinki";
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
