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
        $cities = [
            ['Kabul','AF'],
            ['Tirana','AL'],
            ['Algiers','DZ'],
            ['Luanda','AO'],
            ['Saint','AG'],
            ['Yerevan','AM'],
            ['Canberra','AU'],
            ['Vienna','AT'],
            ['Baku','AZ'],
            ['Nassau','BS'],
            ['Manama','BH'],
            ['Dhaka','BD'],
            ['Bridgetown','BB'],
            ['Minsk','BY'],
            ['Brussels','BE'],
            ['Belmopan','BZ']

            ];

        foreach ($cities as $index => $city) {
            $googlePlaces = new PlacesApi('AIzaSyCGotEjMvi4hDoIuC1yZmcIgYdi8TNRDH0');
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
