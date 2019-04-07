<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
    	  $animaldb = DB::table('animals');
    	  $adoptionRecordsdb = DB::table('adoption-_records');
    	  
        return view('home', ['animaldb' => $animaldb, 'adoptionRecordsdb'=>$adoptionRecordsdb]);
    }
}
