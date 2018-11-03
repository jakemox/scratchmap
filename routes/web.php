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

Route::get('/list', 'CountryController@list')->name('list');
Route::get('/', 'CountryController@index');
Route::post('/', 'CountryController@store');
Route::resource('/country', 'CountryController');

Auth::routes();

Route::get('/home', 'CountryController@index')->name('home');
