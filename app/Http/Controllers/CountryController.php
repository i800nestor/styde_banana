<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Country;
use Illuminate\Validation\Rule;

class CountryController extends Controller
{
    public function index()
    {
    	$countries = Country::all();

        if ( isset( $_GET['e'] ) && $_GET['e'] == 'true' ) {
            
            $error_message = 'The country you are trying to eliminate has associated states.';

        }

    	return view('countries.index', compact(
    		'countries',
            'error_message'
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
            'iso' => 'required|max:2|unique:countries,iso',
            'country' => 'required|min:3|max:45|unique:countries,country'
        ], [
            'iso.required' => 'The iso is mandatory',
            'iso.max' => 'This iso maximum 2 characters',
            'iso.unique' => 'This iso is already registered',
            'country.required' => 'The country is mandatory',
            'country.max' => 'This country maximum 45 characters',
            'country.min' => 'This country minimum 3 characters'
        ]);

    	Country::create([
    		'iso' => $data['iso'],
        	'country' => $data['country']
    	]);

    	return redirect()->route('countries.index');
    }

    public function edit(Country $country)
    {
        

        return view('countries.edit', ['country' => $country]);

    }

    public function update(Country $country)
    {
        $data = request()->validate([
            'iso' => [
                'required',
                'max:2',
                Rule::unique('countries')->ignore($country->id)
            ],
            'country' => [
                'required',
                'min:3',
                'max:45',
                Rule::unique('countries')->ignore($country->id)
            ]
        ], [
            'iso.required' => 'The iso is mandatory',
            'iso.max' => 'This iso maximum 2 characters',
            'iso.unique' => 'This iso is already registered',
            'country.required' => 'The country is mandatory',
            'country.max' => 'This country maximum 45 characters',
            'country.min' => 'This country minimum 3 characters',
            'country.unique' => 'This country is already registered',
        ]);

        $country->update($data);

        return redirect()->route('countries.index');
    }

    public function archived(Country $country)
    {
        $data = request()->validate([
            'archived' => ''
        ]);

        $country->update($data);

        return redirect()->route('countries.index');
    }

    public function destroy(Country $country)
    {

        try {
            
            $country->delete();

            return redirect()->route('countries.index');

        } catch (\Illuminate\Database\QueryException $e) {
            
            return redirect()->route('countries.index', ['e' => 'true']);

        }
    }
}
