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

/*  Rutas de paises  */

Route::get('/countries', 'CountryController@index')
	->name('countries.index');

Route::get('/countries/{country}', 'CountryController@show')
	->where('country', '[0-9]+')
	->name('countries.show');

Route::get('/countries/new', 'CountryController@new')
	->name('countries.new');

Route::post('/countries/create', 'CountryController@create')
	->name('countries.create');

Route::get('countries/{country}/edit', 'CountryController@edit')
	->name('countries.edit');

Route::put('/countries/{country}', 'CountryController@update')
	->name('countries.update');

Route::put('countries/{country}/archived', 'CountryController@archived')
	->name('countries.archived');

Route::delete('/countries/{country}', 'CountryController@destroy')
	->name('countries.delete');

/*  Rutas de ciudades  */

Route::get('cities', 'CityController@index')
	->name('cities.index');

Route::get('/cities/new', 'CityController@new')
	->name('cities.new');

Route::post('/cities/create', 'CityController@create')
	->name('cities.create');