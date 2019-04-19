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
		else if($showOptions == 'Guinnea Pigs'){
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
			$animals = $animals->sortBy('DOB');
		}
		else if($sort_by=='Name') {
			$animals = $animals->sortBy('name');
		}
		
		
		return back()->with('animals', $animals);	
	}
}