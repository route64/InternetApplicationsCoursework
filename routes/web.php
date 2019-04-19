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

/*Route::get('/', function () {
    return view('home');
});*/

Route::get('/about', function(){
	return view('welcome');
});

/*Route::get('/animals', function(){
	$animals = DB::table('animals')->get();
	return view('animals', ['animals' => $animals]);
});*/
Route::get('/animals', 'AnimalDisplayController@displayAllAnimals')->name('animals.sort');
Route::post('/animals', 'AnimalDisplayController@sortAnimals')->name('animals.sort.post');

Route::get('/animal-display/{id}', 'DisplayPet@displayAnimal')->name('image.navigate');
//Route::post('/animal-display/{animal_id}{image_id}', 'DisplayPet@previousImagePost')->name('image.previous.post');
Route::post('/animal-display/{image_id}', 'DisplayPet@nextImagePost')->name('image.next.post');

Route::get('adoption-record/{ref_id}', 'DisplayPet@displayApplication');

Route::get('viewRecords', 'DisplayPet@displayRecords');//, function () {

Route::get('/newRecord', 'ImageUploadController@imageUpload')->name('image.upload');
Route::post('/newRecord', 'ImageUploadController@imageUploadPost')->name('image.upload.post');

Route::get('/newRecordCreated', function () {
	return view('upload');
});

Route::get('/contact', function(){
	return view('contact');
});

Route::get('/home', function(){
	return view('home');
});

Route::get('/staff', function(){
	$staff = DB::table('staff')->get();
	$users = DB::table('users')->get();
	$images = DB::table('images')->get();
	return view('staff', ['staff'=>$staff, 'users'=>$users, 'images'=>$images]);
});
Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
Route::get('/home', 'HomeController@index')->name('home');
