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

Route::get('/upload', function () {
    return view('upload');
})->middleware('auth');

Route::get('form','ImageUploadController@create');
Route::post('form','ImageUploadController@store');

Route::get('/welcome', function () {
    return view('welcome');
})->middleware('auth');

Route::get('/scores/{userid}/{submissionid}', function ($userid, $submissionid) {
    return View::make('/scores')->with('userid', $userid);
})->middleware('auth');

Route::get('/download', function () {
    return view('download');
})->middleware('auth');

Route::get( '/download/{userID}/{submissionID}', 'DownloadController@getDownload')->middleware('auth');

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');

