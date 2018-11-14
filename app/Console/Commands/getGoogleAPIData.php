<?php

namespace App\Console\Commands;

use SKAgarwal\GoogleApi\PlacesApi;
use Illuminate\Console\Command;
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
        $city = ["Helsinki", "FI"];

        $googlePlaces = new PlacesApi('AIzaSyCGotEjMvi4hDoIuC1yZmcIgYdi8TNRDH0');
        $attractions = $googlePlaces->textSearch($city[0].'+attraction', [
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

        var_dump($photos);
        var_dump($attractions);

        // DB::table('attractions')
        //     ->update([
        //         'name' => $country_data->population,
        //         'city_name' => $country_data->capital,
        //         'country_name' => $country_data->area,
        //         'photo' => $country_data->currencies[0]->name,
        //         'language' => $country_data->languages[0]->name
        //     ]);
    }
    }
}
