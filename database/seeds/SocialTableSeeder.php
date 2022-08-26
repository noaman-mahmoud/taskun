<?php

use App\Models\Social;
use Illuminate\Database\Seeder;

class SocialTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('socials')->insert([
            'icon'              => 'facebook.png',
            'name'              => 'facebook',
            'link'              => 'https://www.facebook.com',
        ]);
        DB::table('socials')->insert([
            'name'              => 'instgram',
            'icon'              => 'Instagram.png',
            'link'              => 'https://www.instgram.com',
        ]);
        DB::table('socials')->insert([
            'name'              => 'twitter',
            'icon'              => 'twitter.png',
            'link'              => 'https://www.twitter.com',
        ]);
    }
}
