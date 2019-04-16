<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Animals;

class AnimalsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //created an instance of Faker class to the variable $faker
			$faker = Faker::create();
			$date = new DateTime();			
			
			$users = Animals::all()->pluck('id')->toArray();
			//generate 10 records
			//id=1
			DB::table('animals')->insert([
				'name'=> 'Trissy',
				'gender' =>'FEMALE',
				'DOB'=>'2016-3-13',
				'species' =>'CAT',
				'description' => 'A young grey cat with yellow eyes. Very friendly once you get to know her, but keep her away from children.',
				'primary_image_location' => '../resources/images/Pets/GreyCat_Trissy1.jpg',
				'adopted' => 0,
				'created_at' => $date          
			]);
			//id=2
			DB::table('animals')->insert([
				'name'=> 'Tony',
				'gender' =>'MALE',
				'DOB'=>'2017-7-23',
				'species' =>'HAMSTER',
				'description' => 'Syrian Hamster called Tony. Found at the side of a motorway',
				'primary_image_location' => '../resources/images/Pets/SyrianHamster_lg_Tony1.jpg',
				'adopted' => 0,
				'created_at' => $date
			]);
			//id=3
			DB::table('animals')->insert([
				'name'=> 'Sandy',
				'gender' =>'FEMALE',
				'DOB'=>'2014-9-5',
				'species' =>'DOG',
				'description' => 'A golden retriever, rescued from a bad home. She will bark a lot when meets new people but very friendly once you get to know him.',
				'primary_image_location' => '../resources/images/Pets/GoldenRetriever_Sandy1.jpg',
				'adopted' => 0,
				'created_at' => $date       
			]);
			//id=4
			DB::table('animals')->insert([
				'name'=> 'Giles',
				'gender' =>'MALE',
				'DOB'=>'2010-3-1',
				'species' =>'DOG',
				'description' => 'An elderly German Shepherd with a limp presumably due to being hit by a car 6 months ago. He was brought to the sanctuary after a hit and run by animal rescue. Former owners unknown. Former medical history unknown.',
				'primary_image_location' => '../resources/images/Pets/GermanShepherd_Giles1.jpg',
				'adopted' => 0,
				'created_at' => $date
			]);
			//id=5
			DB::table('animals')->insert([
				'name'=> 'Tesha',
				'gender' =>'FEMALE',
				'DOB'=>'2016-2-23',
				'species' =>'BIRD',
				'description' => 'A Blue Parrot called Tesha. She is a lively and talkative bird, however cannot fly very well due to one clipped wing. She was rescued from an abandoned house by Animal Rescue after neighbors heard her talking. She likes seeds and nuts, especially peanuts.',
				'primary_image_location' => '../resources/images/Pets/BlueParrot_Tesha1.jpg',
				'adopted' => 0,
				'created_at' => $date
			]);
			//id=6
			DB::table('animals')->insert([
				'name'=> 'Loki',
				'gender' =>'MALE',
				'DOB'=>'2016-2-23',
				'species' =>'GUINNEA PIG',
				'description' => 'A Brown male guinnea pig called Loki due to his mischievous behavior. This fellow likes to escape from his cage and go exploring. He likes the dark. He will eat anything given to him, but is especially fond of anything green.',
				'primary_image_location' => '../resources/images/Pets/BrownGuinneaPig_Loki1.jpg',
				'adopted' => 0,
				'created_at' => $date
			]);
			//id=7
			DB::table('animals')->insert([
				'name'=> 'Diddy',
				'gender' =>'FEMALE',
				'DOB'=>'2015-7-11',
				'species' =>'CAT',
				'description' => 'Diddy has Heterochroma iridum, which is why her eyes are different colours. She is playful, fun and enjoys being outside.',
				'primary_image_location' => '../resources/images/Pets/OddEyedCat_Diddy1.jpg',
				'adopted' => 0,
				'created_at' => $date
			]);
			//id=8
			DB::table('animals')->insert([
				'name'=> 'Twitchy',
				'gender' =>'MALE',
				'DOB'=>'2008-5-4',
				'species' =>'RABBIT',
				'description' => 'Twitchy is a bit of an escape artist and enjoys being outside. He can run very fast and jump quite high. He likes carrot peel and dandelion leaves.',
				'primary_image_location' => '../resources/images/Pets/BlackAndWhiteRabbit_Twitchy.jpg',
				'adopted' => 0,
				'created_at' => $date 
			]);
    }
}
