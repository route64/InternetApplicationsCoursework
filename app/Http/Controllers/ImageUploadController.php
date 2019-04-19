<?php

  

namespace App\Http\Controllers;

  

use Illuminate\Http\Request;
use DateTime;
use DB;
use App\Animals;
use App\Images;
  

class ImageUploadController extends Controller

{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function imageUpload()
    {
        return view('newAnimal');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function imageUploadPost()
    {
    	//Check than only images are being uploaded by checking the extensions
        request()->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

		  $name = request()->petName;
        $imageName = $name  . '1' .  '.' .request()->image->getClientOriginalExtension();
		  $dob = request()->dob;
		  $description = request()->desc;
		  $gender = request()->gender;
		  $species = request()->species;
		  
        request()->image->move(public_path('../resources/images/Pets/'), $imageName);
			
			$date = new DateTime();
			DB::table('animals')->insert([
				'created_at'=> $date,
				'name' => $name,
				'gender'=>$gender,
				'DOB'=>$dob,
				'description'=>$description,
				'species'=>$species,
				'primary_image_location'=>'temp',
				'adopted'=>0
			]);
			
			$animal_id =  DB::table('animals')->where('created_at', $date)->first()->id;
			DB::table('animals')->update(['primary_image_location'=>'../resources/images/Pets/'.$animal_id.$imageName]);
			
			DB::table('images')->insert([
				'created_at'=> $date,
				'ref_type'=>'PET',
				'ref_id'=> $animal_id,
				'image_location'=>'../resources/images/Pets/'.$imageName,
				'source'=>'Uploaded from website'
			]);
	
			if(request()->image2 != null) {
				$image2Name = $animal_id . $name . '2'.request()->image2->getClientOriginalExtension();
				request()->image2->move(public_path('../resources/images/Pets/'), $image2Name);
				DB::table('images')->insert([
				'created_at'=> $date,
				'ref_type'=>'PET',
				'ref_id'=> $animal_id,
				'image_location'=>'../resources/images/Pets/'.$image2Name,
				'source'=>'Uploaded from website'
				]);
			}
			if(request()->image3 != null) {
				$image3Name = $animal_id . $name . '3'.request()->image3->getClientOriginalExtension();
				request()->image3->move(public_path('../resources/images/Pets/'), $image3Name);
				DB::table('images')->insert([
				'created_at'=> $date,
				'ref_type'=>'PET',
				'ref_id'=> $animal_id,
				'image_location'=>'../resources/images/Pets/'.$image3Name,
				'source'=>'Uploaded from website'
				]);
			}
			if(request()->image4 != null) {
				$image4Name = $animal_id . $name . '4'.request()->image4->getClientOriginalExtension();
				request()->image4->move(public_path('../resources/images/Pets/'), $image4Name);
				DB::table('images')->insert([
				'created_at'=> $date,
				'ref_type'=>'PET',
				'ref_id'=> DB::table('animals')->where('created_at', $date)->first()->id,
				'image_location'=>'../resources/images/Pets/'.$image4Name,
				'source'=>'Uploaded from website'
				]);
			}
			
        return back()
            ->with('success','You have successfully added a new record.')
            ->with('image',$imageName);
    }

}