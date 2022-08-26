<?php

use App\Models\Complaint;
use Illuminate\Database\Seeder;

class ComplaintTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Complaint::create([
            'title'       => 'Noaman' ,
            'phone'       => '001332422442' , 
            'email'       => 'noaman@gmail.com' ,
            'user_id'     => 1 , 
            'complaint'   => 'معامله ' ,
        ]);
    }
}
