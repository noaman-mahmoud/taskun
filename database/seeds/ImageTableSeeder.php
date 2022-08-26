<?php

use Illuminate\Database\Seeder;

class ImageTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('images')->insert([
            'image'          => '1.png' , 
        ]);
        DB::table('images')->insert([
            'image'          => '2.png' , 
        ]);
        DB::table('images')->insert([
            'image'          => '3.png' , 
        ]);
        DB::table('images')->insert([
            'image'          => '4.png' , 
        ]);
    }
}
