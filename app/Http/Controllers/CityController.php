<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\City;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;

class CityController extends Controller
{
    public function index()
    {
    	$cities = City::all();

    	return view('cities.index', compact(
    		'cities'
    	));
    }

    public function new()
    {
    	//$states = DB::select('SELECT id, state FROM states ORDER BY state;');

    	//where('columna', 'operador', 'valor')

    	$states = DB::table('states')
    		->select('id', 'state')
    		->get();
    	
    	return view( 'cities.new', compact('states') );

    }

    public function create()
    {
        /*
        Recibir datos con el metodo request
        validar datos con el metodo validate
        */
    	$data = request()->validate([
            'state_id' => 'required',
            'city' => 'required|min:3|max:45',
            'capital' => ''
        ], [
            'state_id.required' => 'The state is mandatory',
            'city.required' => 'The city is mandatory',
            'city.max' => 'This city maximum 45 characters',
            'city.min' => 'This city minimum 3 characters'
        ]);

        if ( !isset($data['capital']) ) {
        	
        	$data['capital'] = 0;

        }

    	City::create([
    		'state_id' => $data['state_id'],
        	'city' => $data['city'],
        	'capital' => $data['capital']
    	]);

    	return redirect()->route('cities.index');
    }
}
