<?php

namespace App\Http\Controllers;

use App\Animals;
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
}
