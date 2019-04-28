<?php

namespace App\Http\Controllers;

use App\Animals;
use Illuminate\Http\Request;
use DB;

class AnimalDisplayController extends Controller{
	public function displayAllAnimals(){
		$animals = DB::table('animals')->get();
		return view('animals', ['animals' => $animals]);	
	}
	
	public function sortAnimals(){
		$animals = DB::table('animals')->get();
		//Establish which animals are being shown and retrieve only those animals
		$showOptions = request()->show_by_species;
		if($showOptions == 'Cats'){
			$animals = DB::table('animals')->where('species', 'CAT')->get();
		}
		else if($showOptions == 'Dogs'){
			$animals = DB::table('animals')->where('species', 'DOG')->get();
		}
		else if($showOptions == 'Birds'){
			$animals = DB::table('animals')->where('species', 'BIRD')->get();
		}
		else if($showOptions == 'Guinea Pigs'){
			$animals = DB::table('animals')->where('species', 'GUINNEA PIG')->get();
		}
		else if($showOptions == 'Hamsters'){
			$animals = DB::table('animals')->where('species', 'HAMSTER')->get();
		}
		else if($showOptions == 'Rabbits'){
			$animals = DB::table('animals')->where('species', 'RABBIT')->get();
		}
		
		//Establish the new order from the sort_by selection
		$sort_by = request()->sort_by;
		
		if($sort_by=='DOB Descending') {
			$animals = $animals->sortByDesc('DOB');
		}
		elseif($sort_by=='DOB Ascending') {
			$animals =  $animals->sortBy('DOB');
		}
		elseif($sort_by=='Name') {
			$animals =  $animals->sortBy('name');
		}
		elseif($sort_by=='Applications Ascending'){
			$animals =  $animals;
		}
		
		return back()->with('animals', $animals)
							->with('chosen_species', $showOptions)
							->with('sorted_by', $sort_by);	
	}
	
	
	/**Used for sorting the applications apart, to view only one type, e.g. accepted, denied or pending*/
	public function sortApplications(){
		$records = $this->getRecordsOnStatus(request()->show_by);
		
		return back()->with('adoptionRecords', $records)->with('option', request()->show_by);
	}
	/*Returns the rows from the table with the desired status only*/
	private function getRecordsOnStatus($status){
		if($status == 'Accepted'){
			$records = DB::table('adoption-_records')->where('status', 'ACCEPTED')->get();
		}
		elseif($status == 'Declined'){
			$records = DB::table('adoption-_records')->where('status', 'DECLINED')->get();
		}
		elseif($status == 'Pending') {
			$records = DB::table('adoption-_records')->where('status', 'PENDING')->get();
		}
		else {
			$records = DB::table('adoption-_records')->get();
		}
		return $records->sortBy('created_at');
	}
	
}