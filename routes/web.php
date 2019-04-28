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

Route::get('/edit', 'EditUserInfoController@display');
Route::post('/edit/{username}', 'EditUserInfoController@updateUserInfo')->name('user.info.post');

Route::get('/animals', 'AnimalDisplayController@displayAllAnimals')->name('animals.sort');
Route::post('/animals/{purpose}', 'AnimalDisplayController@sortAnimals')->name('animals.sort.post');

//Display animal for users to submit adoption request
Route::get('/animal-display/{id}', 'DisplayPet@displayAnimal');
Route::post('/animal-display/{image_id}/{option}/{user_id}', 'DisplayPet@mainController')->name('display.control.post');

Route::get('viewRecords', 'DisplayPet@displayRecords');
Route::post('viewRecords/', 'AnimalDisplayController@sortApplications')->name('adoptions.sort.post');

Route::get('/adoption-record/{ref_id}', 'DisplayPet@displayApplication');

Route::get('/newRecord', 'ImageUploadController@imageUpload')->name('image.upload');
Route::post('/newRecord', 'ImageUploadController@imageUploadPost')->name('image.upload.post');

Route::get('/newRecordCreated', function () {
	return view('upload');
});

Route::get('/contact', function(){
	return view('contact');
});
Route::post('/contact/{field}', 'EditContactInfoController@editContactDetails')->name('info.update.post');

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
