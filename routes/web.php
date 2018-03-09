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
})->name('welcome');

Route::get('/countries', 'CountryController@index')
	->name('countries.index');

Route::get('/countries/{country}', 'CountryController@show')
	->where('country', '[0-9]+')
	->name('countries.show');

Route::get('/countries/new', 'CountryController@new')
	->name('countries.new');

Route::post('/countries/create', 'CountryController@create')
	->name('countries.create');
