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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home')->middleware('phone.verified');

// phone
Route::group(['prefix' => 'verify/phone', 'middleware' => ['auth']], function () {
    Route::get('/', 'Auth\PhoneController@verify')->name('verify.phone');
    Route::post('/update', 'Auth\PhoneController@update')->name('verify.phone.update');
});
