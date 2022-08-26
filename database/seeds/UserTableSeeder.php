<?php

use Illuminate\Database\Seeder;
use App\Models\User;
use Faker\Factory as Faker;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker =         Faker::create('ar_SA');
        for ($i=0; $i < 10 ; $i++) {
            User::create([
                'name'      => $faker->name,
                'phone'     => $faker->unique()->phoneNumber,
                'email'     => $faker->unique()->email,
                'password'  => 123456,
                'block'     => rand(0,1),
                'active'    => rand(0,1),
            ]);
        }
    }
}
