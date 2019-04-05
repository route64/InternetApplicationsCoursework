<?php

use Illuminate\Database\Seeder;
use App\Staff;

class StaffTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('staff')->insert([
        		'user_id' => 2,
				'username' => 'gowens1',
				'role' => 'ADMIN',
				'pay_scale' => '3',
				'DOB' => '1974-3-3',
				'start_date' => '1996-9-5'        
        ]);
        DB::table('staff')->insert([
        		'user_id' => 3,
				'username' => 'michaelc1',
				'role' => 'VET',
				'pay_scale' => '5',
				'DOB' => '1971-4-13',
				'start_date' => '2010-9-21'        
        ]);
        DB::table('staff')->insert([
        		'user_id' => 5,
				'username' => 'beakert1',
				'role' => 'ASSISTANT',
				'pay_scale' => '2',
				'DOB' => '2000-1-30',
				'start_date' => '2018-7-5'        
        ]);
    }
}
