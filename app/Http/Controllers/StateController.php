<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\State;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;

class StateController extends Controller
{
    public function index()
    {
    	$states = DB::select('
            SELECT states.id, countries.country, states.iso, states.state, states.archived
            FROM countries, states
            WHERE countries.id = states.country_id
            ORDER BY countries.country, states.state;
        ');

    	if ( isset( $_GET['e'] ) && $_GET['e'] == 'true' ) {
            
            $error_message = 'The state you are trying to eliminate has associated city.';

        }

    	return view('states.index', compact(
    		'states',
    		'error_message'
    	));
    }

    public function new()
    {
    	//$states = DB::select('SELECT id, state FROM states ORDER BY state;');

    	//where('columna', 'operador', 'valor')

    	$countries = DB::table('countries')
    		->select('id', 'country')
            ->orderBy('country')
    		->get();
    	
    	return view( 'states.new', compact('countries') );

    }

    public function create()
    {
        /*
        Recibir datos con el metodo request
        validar datos con el metodo validate
        */
    	$data = request()->validate([
            'country_id' => 'required|min:1',
            'iso' => 'required|min:3|max:5',
            'state' => 'required|min:3|max:45'
        ], [
            'country_id.required' => 'Select a country',
            'country_id.min' => 'Select a country',
            'state.required' => 'The state is mandatory',
            'state.max' => 'This state maximum 45 characters',
            'state.min' => 'This state minimum 3 characters'
        ]);

    	State::create([
    		'country_id' => $data['country_id'],
    		'iso' => $data['iso'],
        	'state' => $data['state']
    	]);

    	return redirect()->route('states.index');
    }

    public function edit(State $state)
    {
    	$countries = DB::table('countries')
    		->select('id', 'country')
    		->get();

    	$country_reg = DB::table('countries')
    		->select('country')
    		->where('id', '=', $state->country_id)
    		->first();
        
        return view('states.edit', [
        	'state' => $state,
        	'countries' => $countries,
        	'country_reg' => $country_reg
        ] );

    }

    public function update(State $state)
    {
        $data = request()->validate([
            'country_id' => 'required|min:1',
            'iso' => 'required|min:3|max:5',
            'state' => 'required|min:3|max:45'
        ], [
            'country_id.required' => 'Select a country',
            'country_id.min' => 'Select a country',
            'state.required' => 'The state is mandatory',
            'state.max' => 'This state maximum 45 characters',
            'state.min' => 'This state minimum 3 characters'
        ]);

        $state->update($data);

        return redirect()->route('states.index');
    }

    public function archived(State $state)
    {
        $data = request()->validate([
            'archived' => 'required'
        ]);

        $state->update($data);

        return redirect()->route('states.index');
    }

    public function destroy(State $state)
    {

        try {
            
            $state->delete();

            return redirect()->route('states.index');

        } catch (\Illuminate\Database\QueryException $e) {
            
            return redirect()->route('states.index', ['e' => 'true']);

        }
    }
}
