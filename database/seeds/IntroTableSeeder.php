<?php

use Illuminate\Database\Seeder;

class IntroTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('intros')->insert([
            'image'          => '1.png' , 
            'title'          => json_encode(['ar' => 'مرحبا بك في تطبيقنا', 'en' => 'Welcome to our app' ]) ,
            'description'    => json_encode(['ar' => 'يحتوي التطبيق علي العديد من المميزات التي تسهل تجربة المستخدم' , 'en' => 'The application contains many features that facilitate the user experience' ]) ,
        ]);
        DB::table('intros')->insert([
            'image'          => '2.png' , 
            'title'          => json_encode(['ar' => 'طريقة الاستخدام', 'en' => 'How to use' ]) ,
            'description'    => json_encode(['ar' => 'يوجد نوعين من المستخدمين في التطبيق يجب الاختيار بينهم' , 'en' => 'There are two types of users in the application to choose between them' ]) ,
        ]);
    }
}
