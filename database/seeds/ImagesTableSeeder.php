<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Animals;

class ImagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('images')->insert([
				'ref_id'=> 1,
				'ref_type' => 'PET',
				'image_location' => '../resources/images/Pets/1GreyCat_Trissy1.jpg',
				'source' => 'https://www.flickr.com/search/?text=household%20cat'         
        ]);
        DB::table('images')->insert([
				'ref_id'=> 1,
				'ref_type' => 'PET',
				'image_location' => '../resources/images/Pets/1GreyCat_Trissy2.jpg',
				'source' => 'https://www.flickr.com/search/?text=household%20cat'         
        ]);
        
        DB::table('images')->insert([
				'ref_id'=> 2,
				'ref_type' => 'PET',
				'image_location' => '../resources/images/Pets/2SyrianHamster_lg_Tony1.jpg',
				'source' => 'https://www.flickr.com/search/?text=hamster'         
        ]);
        DB::table('images')->insert([
				'ref_id'=> 2,
				'ref_type' => 'PET',
				'image_location' => '../resources/images/Pets/2SyrianHamster_sm_Tony3.jpg',
				'source' => 'https://www.flickr.com/search/?text=hamster'         
        ]);
        
        DB::table('images')->insert([
				'ref_id'=> 3,
				'ref_type' => 'PET',
				'image_location' => '../resources/images/Pets/3GoldenRetriever_Sandy1.jpg',
				'source' => 'Photo by Anthony Maina on Unsplash'         
        ]);
        DB::table('images')->insert([
				'ref_id'=> 3,
				'ref_type' => 'PET',
				'image_location' => '../resources/images/Pets/3GoldenRetriever_Sandy2.jpg',
				'source' => 'Photo by Max Sandelin on Unsplash'         
        ]);
        
		  DB::table('images')->insert([
				'ref_id'=> 4,
				'ref_type' => 'PET',
				'image_location' => '../resources/images/Pets/4GermanShepherd_Giles1.jpg',
				'source' => 'Photo by K Zoltan from Pexels'         
        ]);
        DB::table('images')->insert([
				'ref_id'=> 4,
				'ref_type' => 'PET',
				'image_location' => '../resources/images/Pets/4GermanShepherd_Giles2.jpg',
				'source' => 'Photo by K Zoltan from Pexels'         
        ]);
        
        DB::table('images')->insert([
				'ref_id'=> 5,
				'ref_type' => 'PET',
				'image_location' => '../resources/images/Pets/5BlueParrot_Tesha1.jpg',
				'source' => 'Photo by Pixabay from Pexels https://www.pexels.com/photo/animal-avian-beak-bird-434041/  (free to use)'         
        ]);
        DB::table('images')->insert([
				'ref_id'=> 5,
				'ref_type' => 'PET',
				'image_location' => '../resources/images/Pets/5BlueParrot_Tesha2.jpg',
				'source' => 'Photo by Magda Ehlers from Pexels'         
        ]);
        
        DB::table('images')->insert([
				'ref_id'=> 6,
				'ref_type' => 'PET',
				'image_location' => '../resources/images/Pets/6BrownGuinneaPig_Loki1.jpg',
				'source' => 'Photo by Pixabay from Pexels'         
        ]);
        DB::table('images')->insert([
				'ref_id'=> 6,
				'ref_type' => 'PET',
				'image_location' => '../resources/images/Pets/6BrownGuinneaPig_Loki2.jpg',
				'source' => 'Photo by Pixabay from Pexels'         
        ]);
        
        DB::table('images')->insert([
				'ref_id'=> 7,
				'ref_type' => 'PET',
				'image_location' => '../resources/images/Pets/7OddEyedCat_Diddy1.jpg',
				'source' => 'Photo by Dids from Pexels'         
        ]);
        DB::table('images')->insert([
				'ref_id'=> 7,
				'ref_type' => 'PET',
				'image_location' => '../resources/images/Pets/7OddEyedCat_Diddy2.jpg',
				'source' => 'Photo by Dids from Pexels'         
        ]);
        
        DB::table('images')->insert([
				'ref_id'=> 8,
				'ref_type' => 'PET',
				'image_location' => '../resources/images/Pets/8BlackAndWhiteRabbit_Twitchy.jpg',
				'source' => 'Own photo'         
        ]);
        
        //People
        //id=2
        DB::table('images')->insert([
				'ref_id'=> 2,
				'ref_type' => 'STAFF',
				'image_location' => '../resources/images/People/gowens1.jpg',
				'source' => 'By Public Domain Pictures from Pexels'         
        ]);
        //id=3
        DB::table('images')->insert([
				'ref_id'=> 3,
				'ref_type' => 'STAFF',
				'image_location' => '../resources/images/People/michaelc1.jpg',
				'source' => 'By Rene Asmussen from Pexels'         
        ]);
        //id=5
        DB::table('images')->insert([
				'ref_id'=> 5,
				'ref_type' => 'STAFF',
				'image_location' => '../resources/images/People/beakert1.jpg',
				'source' => 'Photo from flikr'         
        ]);
    }
}
