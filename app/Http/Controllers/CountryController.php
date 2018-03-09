<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Country;

class CountryController extends Controller
{
    public function index()
    {
    	$countries = Country::all();

    	return view('countries.index', compact(
    		'countries'
    	));
    }

    public function show(Country $country)
    {

    	return view('countries.show', compact('country'));

    }

    public function new()
    {
    	
    	return view('countries.new');

    }

    public function create()
    {
        /*
        Recibir datos con el metodo request
        validar datos con el metodo validate
        */
    	$data = request()->validate([
            'iso' => 'required|max:2',
            'country' => 'required|min:3|max:45'
        ], [
            'iso.required' => 'The field is mandatory',
            'iso.max' => 'This field maximum 2 characters',
            'country.required' => 'The field is mandatory',
            'country.max' => 'This field maximum 45 characters',
            'country.min' => 'this field minimum 3 characters'
        ]);

    	Country::create([
    		'iso' => $data['iso'],
        	'country' => $data['country']
    	]);

    	return redirect()->route('countries.index');
    }
}
