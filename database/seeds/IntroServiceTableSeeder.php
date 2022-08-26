<?php

use App\Models\IntroService;
use Illuminate\Database\Seeder;

class IntroServiceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        IntroService::create([
            'title'        => ['ar' => 'اسم الخدمة الاولي' , 'en' => 'first service name' ],
            'description'  => ['ar' => 'وصف الخدمه وصف الخدمه وصف الخدمهوصف الخدمهوصف الخدمهوصف الخدمه وصف الخدمه وصف الخدمه  الاولي' , 'en' => 'first service title service title service title service title service title service title service title service title service title '],
        ]);
        IntroService::create([
            'title'        => ['ar' => 'اسم الخدمة الثانية' , 'en' => 'secound service name' ],
            'description'  => ['ar' => 'وصف الخدمه وصف الخدمه وصف الخدمهوصف الخدمهوصف الخدمهوصف الخدمه وصف الخدمه وصف الخدمه  الثانية' , 'en' => 'secound service title service title service title service title service title service title service title service title service title '],
        ]);
        IntroService::create([
            'title'        => ['ar' => 'اسم الخدمة الثالثة' , 'en' => 'third service name' ],
            'description'  => ['ar' => 'وصف الخدمه وصف الخدمه وصف الخدمهوصف الخدمهوصف الخدمهوصف الخدمه وصف الخدمه وصف الخدمه  الثالثة' , 'en' => 'third service title service title service title service title service title service title service title service title service title '],
        ]);
        IntroService::create([
            'title'        => ['ar' => 'اسم الخدمة الرابعة' , 'en' => 'fourth service name' ],
            'description'  => ['ar' => 'وصف الخدمه وصف الخدمه وصف الخدمهوصف الخدمهوصف الخدمهوصف الخدمه وصف الخدمه وصف الخدمه  الرابعة' , 'en' => 'fourth service title service title service title service title service title service title service title service title service title '],
        ]);
        IntroService::create([
            'title'        => ['ar' => 'اسم الخدمة الخامسة' , 'en' => 'fivth service name' ],
            'description'  => ['ar' => 'وصف الخدمه وصف الخدمه وصف الخدمهوصف الخدمهوصف الخدمهوصف الخدمه وصف الخدمه وصف الخدمه  الخامسة' , 'en' => 'fivth service title service title service title service title service title service title service title service title service title '],
        ]);
        IntroService::create([
            'title'        => ['ar' => 'اسم الخدمة السادسة' , 'en' => 'sexth service name' ],
            'description'  => ['ar' => 'وصف الخدمه وصف الخدمه وصف الخدمهوصف الخدمهوصف الخدمهوصف الخدمه وصف الخدمه وصف الخدمه  السادسة' , 'en' => 'sexth service title service title service title service title service title service title service title service title service title '],
        ]);
    }
}
