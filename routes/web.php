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

Route::get('/', 'CountryController@index')->name('list');
Route::get('/index2', 'CountryController@index2');
Route::post('/', 'CountryController@store');
Route::resource('country', 'CountryController');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
