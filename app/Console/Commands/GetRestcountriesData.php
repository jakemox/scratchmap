<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use GuzzleHttp\Client as GuzzleClient;
use DB;

class GetRestcountriesData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'get:rest-countries-data';

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

        $countries = DB::table('countries')
        ->get();

        foreach($countries as $country)
        {
            $url = 'https://restcountries.eu/rest/v2/alpha/' . $country->code;
            $response = $client->get($url);

            $country_data = json_decode($response->getBody()->getContents());

            DB::table('countries')
            ->where('id', '=', $country->id)
            ->update([
                'population' => $country_data->population,
                'capital' => $country_data->capital,
                'area' => $country_data->area,
                'currency' => $country_data->currencies[0]->name,
                'language' => $country_data->languages[0]->name
            ]);
        }
    }
}
