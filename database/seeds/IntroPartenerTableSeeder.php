<?php

use App\Models\IntroPartener;
use Illuminate\Database\Seeder;

class IntroPartenerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('intro_parteners')->insert([
            'image'  => '1.png' , 
        ]);
        DB::table('intro_parteners')->insert([
            'image'  => '3.png' , 
        ]);
        DB::table('intro_parteners')->insert([
            'image'  => '4.png' , 
        ]);
    }
}
