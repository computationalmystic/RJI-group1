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

Auth::routes();

Route::get('/', function () {
    return view('upload');
})->middleware('auth');

Route::get('form','ImageUploadController@create');
Route::post('form','ImageUploadController@store');

//Route::get('/welcome', function () {
//    return view('welcome');
//})->middleware('auth');;

Route::get('/welcome', function(){
	$details['email'] = 'gavinlikepi@gmail.com';
    dispatch(new App\Jobs\SendNotificationAfterScoring($details));
    dd('done');
});


Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
