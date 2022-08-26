<?php

use App\Models\IntroFqs;
use Illuminate\Database\Seeder;

class IntroFqsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        IntroFqs::create([
            'title'                     => ['ar' => 'السؤال الاول القسم الاول'  , 'en' => 'first question first category'] ,
            'description'               => ['ar' => 'الاجابة الاولي القسم الاول'  , 'en' => 'first answer first category'] ,
            'intro_fqs_category_id'     => 1 ,
        ]);
        IntroFqs::create([
            'title'                     => ['ar' => 'السؤال الثانيه القسم الثاني'  , 'en' => 'secound question secound category'] ,
            'description'               => ['ar' => 'الاجابة الثانية القسم الثاني'  , 'en' => 'secound answer secound category'] ,
            'intro_fqs_category_id'     => 2 ,
        ]);
        IntroFqs::create([
            'title'                     => ['ar' => 'السؤال الثالث القسم الثالث'  , 'en' => 'third question third category'] ,
            'description'               => ['ar' => 'الاجابة الثالثة القسم الثالث'  , 'en' => 'third answer third category'] ,
            'intro_fqs_category_id'     => 3 ,
        ]);
        IntroFqs::create([
            'title'                     => ['ar' => 'السؤال الرابع القسم الرابع'  , 'en' => 'fourth question fourth category'] ,
            'description'               => ['ar' => 'الاجابة الرابعه القسم الرابع'  , 'en' => 'fourth answer fourth category'] ,
            'intro_fqs_category_id'     => 4 ,
        ]);
    }
}
