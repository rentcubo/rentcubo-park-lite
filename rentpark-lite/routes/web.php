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

// Route::get('/home', 'HomeController@index')->name('home');


/**
*
* Users
*
**/

Route::get('/', 'UserController@index')->name('home');
/***
 *
 * Profile management
 *
 */       

Route::get('/profile/edit/{id}', 'UserController@profile_edit')->name('profile.edit');

Route::post('/profile/save', 'UserController@profile_save')->name('profile.save');

Route::get('/profile/view', 'UserController@profile_view')->name('profile.view');

Route::get('/profile/password_check', 'UserController@password_check')->name('password.check');

Route::post('/profile/delete','UserController@profile_delete')->name('profile.delete');

Route::get('/profile/password/', 'UserController@profile_password')->name('profile.password');

Route::post('/profile/password/save', 'UserController@profile_password_save')->name('profile.password.save');


/**
*
* Booking Management
*
**/


	Route::post('/bookings/save/{id}', 'UserController@bookings_save')->name('bookings.save');

	Route::get('/bookings/index', 'UserController@bookings_index')->name('bookings.index');

    Route::get('/bookings/view/{id}', 'UserController@bookings_view')->name('bookings.view');

    Route::get('/bookings/status/{id}', 'UserController@bookings_status')->name('bookings.status');

    Route::post('/bookings/rating/{id}', 'UserController@bookings_rating')->name('bookings.rating');

    Route::get('/bookings/checkin/{id}', 'UserController@bookings_checkin')->name('bookings.checkin');

    Route::get('/bookings/checkout/{id}', 'UserController@bookings_checkout')->name('bookings.checkout');


/***
*
* Hosts management
*
*/       
Route::match(array('GET','POST'),'/hosts/index', 'UserController@hosts_index')->name('hosts.index');

Route::get('/hosts/view/{id}', 'UserController@hosts_view')->name('hosts.view');


/****
*
* Pages
* 
*/
Route::get('/page/{page_type}', 'UserController@pages')->name('pages');


