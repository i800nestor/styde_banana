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

/*  Rutas de estados  */

Route::get('states', 'StateController@index')
	->name('states.index');

Route::get('/states/new', 'StateController@new')
	->name('states.new');

Route::post('/states/create', 'StateController@create')
	->name('states.create');

Route::get('states/{state}/edit', 'StateController@edit')
	->name('states.edit');

Route::put('/states/{state}', 'StateController@update')
	->name('states.update');

Route::put('states/{state}/archived', 'StateController@archived')
	->name('states.archived');

Route::delete('/states/{state}', 'StateController@destroy')
	->name('states.delete');

/*  Rutas de ciudades  */

Route::get('cities', 'CityController@index')
	->name('cities.index');

Route::get('/cities/new', 'CityController@new')
	->name('cities.new');

Route::post('/cities/create', 'CityController@create')
	->name('cities.create');

Route::get('cities/{city}/edit', 'CityController@edit')
	->name('cities.edit');

Route::put('/cities/{city}', 'CityController@update')
	->name('cities.update');

Route::put('cities/{city}/archived', 'CityController@archived')
	->name('cities.archived');

Route::delete('/cities/{city}', 'CityController@destroy')
	->name('cities.delete');

/*  Rutas  de terminos de pagos  */

Route::get('payment_terms', 'PaymentTermController@index')
	->name('payment_terms.index');

Route::get('/payment_terms/{payment_term}', 'PaymentTermController@show')
	->where('payment_term', '[0-9]+')
	->name('payment_terms.show');

Route::get('/payment_terms/new', 'PaymentTermController@new')
	->name('payment_terms.new');

Route::post('/payment_terms/create', 'PaymentTermController@create')
	->name('payment_terms.create');

Route::get('payment_terms/{payment_term}/edit', 'PaymentTermController@edit')
	->name('payment_terms.edit');

Route::put('/payment_terms/{payment_term}', 'PaymentTermController@update')
	->name('payment_terms.update');

Route::delete('/payment_terms/{payment_term}', 'PaymentTermController@destroy')
	->name('payment_terms.delete');

/*  Rutas  de tipos de terminos  */

Route::get('/term_types/{payment_term}/new', 'TermTypeController@new')
	->name('term_types.new');

Route::post('/term_types/create', 'TermTypeController@create')
	->name('term_types.create');

Route::get('term_types/{payment_term}/{term_type}/edit', 'TermTypeController@edit')
	->name('term_types.edit');

Route::put('/term_types/{term_type}', 'TermTypeController@update')
	->name('term_types.update');

Route::delete('/term_types/{term_type}', 'TermTypeController@destroy')
	->name('term_types.delete');