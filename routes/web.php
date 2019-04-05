<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('home');
});

Route::get('/about', function(){
	return view('welcome');
});

Route::get('/animals', function(){
	$animals = DB::table('animals')->get();
	return view('animals', ['animals' => $animals]);
});

Route::get('animal-display/{id}', 'DisplayPet@displayAnimal');
/*Route::get('/animal-display/{id}', function($id){
	$animal = DB::table('animals')->where('id', $id)->get();
	return view('animals', ['animal' => $animal]);
});*/

Route::get('/contact', function(){
	return view('contact');
});

Route::get('/home', function(){
	return view('home');
});

Route::get('/staff', function(){
	return view('staff');
});
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
