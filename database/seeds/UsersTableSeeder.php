<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
			//id=1
			DB::table('users')->insert([
				'title'=>'MS',
				'name'=>'Sarah Wilson',
				'username'=>'KiwiLover64',
				'password' => Hash::make('secretNZlover'),
				'email' =>'KiwiLover64@gmail.com',
				'address' =>'24 Brick Lane, London',
				'post_code' => 'LN2 4BN',
				'phone_no' => '07607320129'
						
			]);
			//id=2
			DB::table('users')->insert([
				'title'=>'MRS',
				'name'=>'Sarah Gowen',
				'username'=>'gowens1',
				'password' => Hash::make('secret'),
				'email' =>'gowens1@aston-sanctuary.co.uk',
				'address' =>'24 Corporation St, Birmingham',
				'post_code' => 'B1 7UJ',
				'type' => 'STAFF',
				'phone_no' => '07607320129'
						
			]);
			//id=3
			DB::table('users')->insert([
				'title'=>'MR',
				'name'=>'Charles Michael',
				'username'=>'michaelc1',
				'password' => Hash::make('secret'),
				'email' =>'michaelc1@aston-sanctuary.co.uk',
				'address' =>'13 Corporation St, Birmingham',
				'post_code' => 'B1 7UJ',
				'type' => 'STAFF',
				'phone_no' => '07607320129'
						
			]);
			//id=4
			DB::table('users')->insert([
				'title'=>'MRS',
				'name'=>'Julia Roberts',
				'username'=>'JRoberts',
				'password' => Hash::make('secretNZlover'),
				'email' => 'lawyer63@yahoo.com',
				'address' =>'11 Aston Street, Birmingham',
				'post_code' => 'B4 7UJ',
				'phone_no' => '07607320129'
						
			]);
			//id=5
			DB::table('users')->insert([
				'title'=>'MISS',
				'name'=>'Tracy Beaker',
				'username'=>'beakert1',
				'password' => Hash::make('secret'),
				'email' =>'beakert1@aston-sanctuary.co.uk',
				'address' =>'9 Bloomsbury Walk, Birmingham',
				'post_code' => 'B6 5UH',
				'type' => 'STAFF',
				'phone_no' => '07607320129'
						
			]);
    }
}
