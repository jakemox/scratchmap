<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use GuzzleHttp\Client as GuzzleClient;
use DB;

class GetMapboxCoords extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'get:mapbox-city-coords';

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
        $client = new GuzzleClient();

        $cities = DB::table('cities')
        ->get();

        foreach($cities as $city)
        {
            $url = 'https://api.mapbox.com/geocoding/v5/mapbox.places/' . urlencode($city->name) . '.json?types=place&access_token=pk.eyJ1IjoiamFrZW1veDk5IiwiYSI6ImNqbmxtYjlvcjFtZmozcHE5aW9zN3pjeXcifQ.UCUt8f58HwBvpHcTz8JqkA';

            $response = $client->get($url);
            $coord_data = json_decode($response->getBody()->getContents());
            var_dump($coord_data);

            if(isset($coord_data->features[0]->center[0]))
            {
                DB::table('cities')
                ->where('id', '=', $city->id)
                ->update([
                    'longitude' => $coord_data->features[0]->center[0],
                    'latitude' => $coord_data->features[0]->center[1]
                ]);
            }
        }
    }
}
