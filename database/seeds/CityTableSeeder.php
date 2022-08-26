<?php

use App\Models\City;
use Illuminate\Database\Seeder;

class CityTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $remote = isset($_SERVER["REMOTE_ADDR"]) ?? false;
        $url = 'database/seeds/json/cities.json' ;
        
        $citiesJson =  file_get_contents($url,true);

        foreach (json_decode($citiesJson) as $city)
        {
            City::create([
                'name'          =>  ['ar' => $city->name_ar , 'en' => $city->name_en ],
                'country_id'    =>  1,
                'lat'           =>  $city->center[0],
                'lng'           =>  $city->center[1],
                'created_at'    => \Carbon\Carbon::now()->subMonth(rand(0,8)),
            ]);
        }
    }
}
