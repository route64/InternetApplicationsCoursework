<?php

namespace App\Http\Controllers;

use App\Animals;
use App\Staff;
use App\adoption_records;
use Illuminate\Http\Request;
use DB;

class DisplayPet extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    function displayAnimal($id) {
    	$animal = DB::table('animals')->where('id', $id)->first();
    	$images = DB::table('images')->where('ref_id', $id)->where('ref_type', 'PET')->get();
    	return view('petDisplay', ['animal' => $animal, 'image' => $images[0]]);
	}
	
	function displayApplication($ref_id){
    	$adoptionRecord=DB::table('adoption-_records')->where('ref_id', $ref_id)->first(); //get the required record from adoption records table
		$animals = DB::table('animals')->get();
		$users = DB::table('users')->get();
    	$images = DB::table('images')->get();  	
    	return view('adoptionRecord', ['adoptionRecord' => $adoptionRecord, 'animals'=>$animals, 'users'=>$users, 'images'=>$images]);
	}	
	
	public function displayRecords(){
		  $staffdb = DB::table('staff')->get();
    	  $animaldb = DB::table('animals')->get();
    	  $adoptionRecordsdb = DB::table('adoption-_records')->get();
    	  return view('viewRecords', ['animaldb' => $animaldb, 'adoptionRecordsdb'=>$adoptionRecordsdb, 'staffdb'=>$staffdb]);
	}
	
	/* 
	 * Pass the animal and current image id to the function
	 */
	public function nextImagePost($animal_id, $image_id){
		$animal = DB::table('animals')->where('id', $animal_id)->first();
		//Get all the image ids for the images of this animal
		$image_ids = DB::table('images')->where('ref_id', $animal_id)->where('ref_type', 'PET')->get('image_id');
		
		//set the new image id to one above the previous
		$current_image_num = 0;
		$count = -1;
		$first_image=1;
		//Iterate through all the image ids for this animal
		foreach($image_ids as $im_id){
			$count += 1;
			if($im_id == $image_id){
				//If the current image id matches the image id provided then set $current_image equal to the current $count value
				$current_image_num = $count;			
			}
		}

		$new_image =0; //DB::table('images')->where('image_id', $image_ids[0]->image_id)->first();

		if (isset($_POST['next'])){
	   	if($current_image_num <= $count){
	   		$current_image_num = $current_image_num+1;
			//Get the next image for this animal
				$image_id = $image_ids[$current_image_num]->image_id;
				$new_image = DB::table('images')->where('image_id', $image_id)->first();
			}	
			if($current_image_num==$count) {
				$last_image=1;
			}else {
				$last_image=0;
			}
		}
		
		else if(isset($_POST['back'])){
			if($current_image_num > 0){
				$current_image_num = $current_image_num-1; //reduce current_image by 1
				$new_image = DB::table('images')->where('image_id', $image_ids[$current_image_num]->image_id)->get();
			}		
		}
		
		if($current_image_num == $count){
			$last_image = 1;
		}
		else {
			$last_image=0;
		}
		if($current_image_num == 0){
			$first_image = 1;			
		}else {
			$first_image = 0;
		}
		return back()->with('last_image', $last_image)->with('first_image', $first_image)
				->with('next_image', $new_image)
				->with('image_num', $current_image_num);
	}
	

}