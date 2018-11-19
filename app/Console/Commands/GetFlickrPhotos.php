<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use GuzzleHttp\Client as GuzzleClient;
use DB;

class GetFlickrPhotos extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'get:flickr-photos';

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

        $cities = DB::table('cities')->get();

        foreach($cities as $city)
        {
            $url = 'https://api.flickr.com/services/rest/?format=json&api_key=' . env('MIX_FLICKR_KEY') .'&text=' . urlencode($city->name) . '&tags=' . urlencode($city->name) . ',cityscape,landmark&method=flickr.photos.search&sort=relevance&nojsoncallback=1&tag_mode=all&sort=relevance&orientation=landscape&media=photos&per_page=1&page=1';

            $response = $client->get($url);
            $city_data = json_decode($response->getBody()->getContents());
            var_dump($cities);
            

            if(isset($city_data->photos->photo[0]))
            {

            $photo = $city_data->photos->photo[0];

            DB::table('cities')
            ->where('id', '=', $city->id)
            ->update([
                'photo' => 'https://c2.staticflickr.com/' . $photo->farm . '/' . $photo->server . '/' . $photo->id . '_' . $photo->secret . '_b.jpg'
            ]);
            }

            // $file_contents = file_get_contents($photo);

            // Storage::put('file.jpg', $file_contents);



        }
    }
}
