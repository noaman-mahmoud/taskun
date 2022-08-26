<?php

use Illuminate\Database\Seeder;

class IntroSocialTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('intro_socials')->insert([
            'icon'             => 'fab fa-facebook-f',
            'key'              => 'facebook',
            'url'              => 'https://www.facebook.com',
        ]);
        DB::table('intro_socials')->insert([
            'icon'             => 'fab fa-twitter',
            'key'              => 'twitter',
            'url'              => 'https://www.twitter.com',
        ]);
        DB::table('intro_socials')->insert([
            'icon'             => 'fab fa-instagram',
            'key'              => 'instagram',
            'url'              => 'https://www.instagram.com',
        ]);
        DB::table('intro_socials')->insert([
            'icon'             => 'fab fa-linkedin-in',
            'key'              => 'linkedin',
            'url'              => 'https://www.linkedin.com',
        ]);
    }
}
