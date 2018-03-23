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
    	$cities = DB::table('cities')
            ->select('cities.id', 'states.state', 'cities.city', 'cities.capital', 'cities.archived')
            ->join('states', 'cities.state_id', '=', 'states.id')
            ->orderBy('states.state', 'ASC', 'cities.city', 'ASC')
            ->paginate(4)
            ;

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
            ->orderBy('state')
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
            'state_id' => 'required|min:1',
            'city' => 'required|min:3|max:45',
            'capital' => 'required'
        ], [
            'state_id.required' => 'Select a state',
            'state_id.min' => 'Select a state',
            'capital.required' => 'Select, whether it is a capital or not',
            'city.required' => 'The city is mandatory',
            'city.max' => 'This city maximum 45 characters',
            'city.min' => 'This city minimum 3 characters'
        ]);

    	City::create([
    		'state_id' => $data['state_id'],
        	'city' => $data['city'],
        	'capital' => $data['capital']
    	]);

    	return redirect()->route('cities.index');
    }

    public function edit(City $city)
    {
    	$states = DB::table('states')
    		->select('id', 'state')
    		->get();

    	$state_reg = DB::table('states')
    		->select('state')
    		->where('id', '=', $city->state_id)
    		->first();
        
        return view('cities.edit', [
        	'city' => $city,
        	'states' => $states,
        	'state_reg' => $state_reg
        ] );

    }

    public function update(City $city)
    {
        $data = request()->validate([
            'state_id' => 'required|min:1',
            'city' => 'required|min:3|max:45',
            'capital' => ''
        ], [
            'state_id.required' => 'Select a state',
            'state_id.min' => 'Select a state',
            'city.required' => 'The city is mandatory',
            'city.max' => 'This city maximum 45 characters',
            'city.min' => 'This city minimum 3 characters'
        ]);

        $city->update($data);

        return redirect()->route('cities.index');
    }

    public function archived(City $city)
    {
        $data = request()->validate([
            'archived' => 'required'
        ]);

        $city->update($data);

        return redirect()->route('cities.index');
    }

    public function destroy(City $city)
    {

        try {
            
            $city->delete();

            return redirect()->route('cities.index');

        } catch (\Illuminate\Database\QueryException $e) {
            
            return redirect()->route('cities.index', ['e' => 'true']);

        }
    }
}
