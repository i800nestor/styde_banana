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
            'iso' => 'required',
            'country' => 'required'
        ], [
            'iso.required' => 'The field is mandatory',
            'country.required' => 'The field is mandatory'
        ]);

    	Country::create([
    		'iso' => $data['iso'],
        	'country' => $data['country']
    	]);

    	return redirect()->route('countries.index');
    }
}
