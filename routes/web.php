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

Route::get('/', 'CountryController@index');
Route::post('/', 'CountryController@store');
// Route::resource('/api', 'CountryController');
Route::get('/api/countries/{id}', 'CountryController@show');
Route::get('/api/countries', 'CountryController@list');
Route::get('/api/visits', 'CountryController@visits');

Route::get('/search', 'SearchController@show');

Route::get('/profile', 'ProfileController@show');

Route::post('profile', 'ProfileController@update_avatar');

Route::get('/city/{city}', 'CityController@index');
Route::post('/city/search', 'CityController@search');
Route::get('/city/show/{city}', 'CityController@show');
Route::get('/city/api/{city}', 'CityController@api');


Auth::routes();
Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout');
Route::get('/home', 'CountryController@index')->name('home');

