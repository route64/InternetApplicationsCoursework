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
    	return view('petDisplay', ['animal' => $animal, 'images' => $images]);
	}
	
	function displayApplication($ref_id){
    	$adoptionRecord=DB::table('adoption-_records')->where('ref_id', $ref_id)->first(); //get the required record from adoption records table
		$animals = DB::table('animals')->get();
		$users = DB::table('users')->get();
    	$images = DB::table('images')->get();  	
    	return view('adoptionRecord', ['adoptionRecord' => $adoptionRecord, 'animals'=>$animals, 'users'=>$users, 'images'=>$images]);
	}	
	
	function displayRecords(){
		  $staffdb = DB::table('staff')->get();
    	  $animaldb = DB::table('animals')->get();
    	  $adoptionRecordsdb = DB::table('adoption-_records')->get();
    	  return view('viewRecords', ['animaldb' => $animaldb, 'adoptionRecordsdb'=>$adoptionRecordsdb, 'staffdb'=>$staffdb]);
	}
}
