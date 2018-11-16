<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use SKAgarwal\GoogleApi\PlacesApi;
use DB;

class getGoogleAPIData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:google-places-cities';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        
        // prepare data for query from cities.csv 
        $cities = [];
        $i = 0;
        $file_handle = fopen("cities.csv", "r");
        
        while (!feof($file_handle)) {
            $line_of_text = fgetcsv($file_handle, 1024);
            $cities[$i] = [$line_of_text[2], $line_of_text[1]];
            $i++;
        }

        fclose($file_handle);
        
        // run the query with the array

        foreach ($cities as $index => $city) {
            $googlePlaces = new PlacesApi(env('MIX_GOOGLE_KEY'));
            $attractions = $googlePlaces->textSearch($city[0] . '+attraction', [
                'type=point_of_interest',
            ])['results'];
            $photos = [];
            foreach ($attractions as $key => $attraction) {
                if (isset($attraction['photos'])) {
                    // dd($attraction['photos'][0]['photo_reference']);
                    $photos[] = $googlePlaces->photo($attraction['photos'][0]['photo_reference'], ['maxwidth' => 500]);
                } else {
                    $photos[] = "";
                }
            }

        // save each response to database

            foreach ($attractions as $key => $attraction) {
                DB::table('attractions')
                    ->insert([
                        'id' => $attraction['place_id'],
                        'name' => $attraction['name'],
                        'city_name' => $city[0],
                        'country_code' => $city[1],
                        'photo' => $photos[$key],
                        'address' => $attraction['formatted_address'],
                        'rating' => $attraction['rating'],
                    ]);
            }
            echo($city[0] . " completed\n");
        }
    }
}
