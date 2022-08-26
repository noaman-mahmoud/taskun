<?php

use App\Models\Country;
use Illuminate\Database\Seeder;

class CountryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        Country::create([
            'name'          => ['ar' => 'السعودية' , 'en' => 'Saudi Arabia'] , 
            'key'           => '+966'   , 
            'created_at'    => \Carbon\Carbon::now()->subMonth(rand(0,6)),
        ]);
        Country::create([
            'name' => ['ar' => 'مصر' , 'en' => 'Egypt'] , 
            'key'  => '+20'   , 
            'created_at'    => \Carbon\Carbon::now()->subMonth(rand(0,6)),

        ]);
        Country::create([
            'name' => ['ar' => 'الامارات' , 'en' => 'UAE'] , 
            'key'  => '+971'   , 
            'created_at'    => \Carbon\Carbon::now()->subMonth(rand(0,6)),

        ]);
        Country::create([
            'name' => ['ar' => 'البحرين' , 'en' => 'El-Bahrean'] , 
            'key'  => '+973'   , 
            'created_at'    => \Carbon\Carbon::now()->subMonth(rand(0,6)),

        ]);
        Country::create([
            'name' => ['ar' => 'قطر' , 'en' => 'Qatar'] , 
            'key'  => '+974'   , 
            'created_at'    => \Carbon\Carbon::now()->subMonth(rand(0,6)),

        ]);
        Country::create([
            'name' => ['ar' => 'ليبيا' , 'en' => 'Libya'] , 
            'key'  => '+218'   , 
            'created_at'    => \Carbon\Carbon::now()->subMonth(rand(0,6)),

        ]);
        Country::create([
            'name' => ['ar' => 'الكويت' , 'en' => 'Kuwait'] , 
            'key'  => '+965'   , 
            'created_at'    => \Carbon\Carbon::now()->subMonth(rand(0,6)),

        ]);
        Country::create([
            'name' => ['ar' => 'عمان' , 'en' => 'Oman'] , 
            'key'  => '‎+968'   , 
            'created_at'    => \Carbon\Carbon::now()->subMonth(rand(0,6)),

        ]);
    }
}
