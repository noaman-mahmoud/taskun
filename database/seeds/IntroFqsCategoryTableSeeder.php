<?php

use Illuminate\Database\Seeder;
use App\Models\IntroFqsCategory;

class IntroFqsCategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        IntroFqsCategory::create([
            'title'  => ['ar' => 'عامة', 'en' => 'public'] ,
        ]);
        IntroFqsCategory::create([
            'title'  => ['ar' => 'التسجيل في التطبيق', 'en' => 'Register in the app'] ,
        ]);
        IntroFqsCategory::create([
            'title'  => ['ar' => 'خدمات التطبيق', 'en' => 'app services'] ,
        ]);
        IntroFqsCategory::create([
            'title'  => ['ar' => 'تعديل البيانات', 'en' => 'edit informations'] ,
        ]);
    }
}
