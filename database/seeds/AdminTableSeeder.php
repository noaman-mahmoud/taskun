<?php

use App\Models\Admin;
use Illuminate\Database\Seeder;

class AdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Admin::create([
            'name'      => 'admin',
            'email'     => 'admin@info.com',
            'phone'     => '0100100100',
            'password'  => 123456,
            'role_id'   => 1,
        ]);
    }
}
