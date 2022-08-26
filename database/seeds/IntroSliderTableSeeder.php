<?php

use App\Models\IntroSlider;
use Illuminate\Database\Seeder;

class IntroSliderTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('intro_sliders')->insert([
            'image'       => '1.png' ,
            'title'       => json_encode(['ar' => 'عنوان البانر الاول', 'en' => 'First banner title ' ]) ,
            'description' => json_encode(['ar' => ' وسف البانر الاول' , 'en' => 'first banner description' ]) ,
        ]);
        DB::table('intro_sliders')->insert([
            'image'       => '2.png' ,
            'title'       => json_encode(['ar' => 'عنوان البانر الثاني', 'en' => 'secound banner title ' ]) ,
            'description' => json_encode(['ar' => ' وسف البانر الثاني' , 'en' => 'secound banner description' ]) ,
        ]);
        DB::table('intro_sliders')->insert([
            'image'       => '1.png' ,
            'title'       => json_encode(['ar' => 'عنوان البانر الثالث', 'en' => 'third banner title ' ]) ,
            'description' => json_encode(['ar' => ' وسف البانر الثالث' , 'en' => 'third banner description' ] ),
        ]);
        DB::table('intro_sliders')->insert([
            'image'       => '2.png' ,
            'title'       => json_encode(['ar' => 'عنوان البانر الرابع', 'en' => 'fourth banner title ' ]) ,
            'description' => json_encode(['ar' => ' وسف البانر الرابع' , 'en' => 'fourth banner description' ]) ,
        ]);
       
    }
}
