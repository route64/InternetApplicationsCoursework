<?php

namespace App\Http\Controllers;

use App\Animals;
use App\Staff;
use App\adoption_records;
use Illuminate\Http\Request;
use DB;
use DateTime;

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
	
	
	public function mainController($id_one, $option, $id_two){
		if($option == 'adopt'){
			return $this->submitApplication($id_one, $id_two);//$id_one = animal_id and $id_two = $user_id
		}
		elseif($option == 'addImage') {
			return $this->addNewImagePost($id_one); //$id_one = animal_id	
		}
		elseif($option == 'changeImage') {
			return $this->changeImagePost($id_one, $id_two); //$id_one = animal_id and $id_two = image_id
		}
		else {
			return back();		
		}
	}
	/* 
	 * Pass the current image id to the function
	 */
	public function changeImagePost($animal_id, $image_num){
		//Get an array of all the images for this animal
		$all_images = DB::table('images')->where('ref_id', $animal_id)->where('ref_type', 'PET')->get();
		$first_image = false;
		$last_image = false;
		
		if (isset($_POST['next'])){
			if($image_num < count($all_images)){
				$image_num ++;
			}
		}
		elseif(isset($_POST['back'])) {
			if($image_num > 0) {
				$image_num --;
			}
		}
		
		$first_image = ($image_num == 0);
		$last_image = ($image_num == count($all_images));
		$new_image = $all_images[$image_num-1];
		
		return back()->with('last_image', $last_image)->with('first_image', $first_image)
				->with('next_image', $new_image)
				->with('current_image', $image_num);
	}
	
	public function addNewImagePost($animal_id){
		$image_ids = DB::table('images')->where('ref_id', $animal_id)->get();
		$animal = DB::table('animals')->where('id', $animal_id)->first();
		
		$message = '';
		
		$validation = request()->validate([
            'new_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);		
		
		if(isset($_POST['add_image'])) {
			$image_num = count($image_ids)+1;
			$imageName = $animal_id . $animal->name . $image_num .  '.' .request()->new_image->getClientOriginalExtension();
			//Move the image in to the file system
			request()->new_image->move(public_path('../resources/images/Pets/'), $imageName);
			
			DB::table('images')->insert([
				'created_at'=> new DateTime(),
				'ref_type'=>'PET',
				'ref_id'=> $animal_id,
				'image_location'=>'../resources/images/Pets/'.$imageName,
				'source'=>'Uploaded from website'
			]);
			
			$message = 'Image Added';
		}
		
		return back()->with('message', $message);
	}	
	
	/* This function is called to submit an application to the adoption-_records table using an insert
	*  statement.
	*	DateTime() is required to set the 'created_at' field.
	*	ref_id is created from combining the user_id and animal_id.
	*	If an application has previously been sent, for instance if they have managed to click the button
	*	twice, then an alert message will pop up telling them that two applications cannot be submitted
	*	by the same person for the same animal.
	*/
	public function submitApplication($animalID, $user_id){
		$applicationSent = 0;
		$message = '<script>alert("Application previously sent! You cannot send two applications for the same animal.")</script>';				
		
		if (isset($_POST['submit_application'])){
		$date = new DateTime();
		try{
			DB::table('adoption-_records')->insert(
			['created_at'=> $date,
			'ref_id'=>$user_id . $animalID ,
			'adopter'=>DB::table('users')->where('id', $user_id)->first()->username , 
			'adoptee_id'=>$animalID, 
			'status'=>'PENDING']);
				
			$applicationSent = 1;
			$message = '<script>alert("Application sent!")</script>';
		}
		catch(Exception $e){
			$message = '<script>alert("Application previously sent! Cannot send two applications for the same animal.")</script>';				
		}
		}
		
		return back()->with('application_sent', $applicationSent)->with('message', $message);
	}
}