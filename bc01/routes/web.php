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

//Route::get('/home', 'HomeController@index')->name('home');

Route::get('reservations/', 'HomeController@doReservation');

Route::get('room_info', 'RoomInfoController@index');

Route::get('/cubeInfo1', 'RoomInfoController@cubeInfo1');

Route::get('/cubeInfo2', 'RoomInfoController@cubeInfo2');

Route::get('floorInfo', 'RoomInfoController@floorInfo');

Route::resource('reservations', 'ReservationController');

//Route::resource('locale', 'ReservationController');

Route::get('/locale/{locale}', function ($locale) {
    Session::put('locale', $locale);
    return redirect()->back();
});
