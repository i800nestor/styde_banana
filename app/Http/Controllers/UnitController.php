<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Unit;
use Illuminate\Validation\Rule;

class UnitController extends Controller
{
    public function index()
    {
    	$units = Unit::orderBy('tag')->paginate(4);

    	return view('units.index', compact(
    		'units'
    	));
    }

    public function new()
    {
    	return view('units.new');
    }

    public function create()
    {
    	$data = request()->validate([
    		'tag' => 'required|min:2|max:45',
            'quantity' => 'required'
    	],[
    		'tag.required' => 'The tag is mandatory',
    		'tag.min' => 'This tag min 2 characters',
    		'tag.max' => 'This tag max 45 characters',
    		'quantity.required' => 'The quantity is mandatory',
    	]);

    	Unit::create([
    		'tag' => $data['tag'],
            'quantity' => $data['quantity']
    	]);

    	return redirect()->route('units.index');
    }

    public function edit(Unit $unit)
    {
    	return view('units.edit', compact('unit'));
    }

    public function update(Unit $unit){

    	$data = request()->validate([
    		'tag' => 'required|min:2|max:45',
            'quantity' => 'required'
    	],[
    		'tag.required' => 'The tag is mandatory',
    		'tag.min' => 'This tag min 2 characters',
    		'tag.max' => 'This tag max 45 characters',
    		'quantity.required' => 'The quantity is mandatory',
    	]);

    	$unit->update($data);

    	return redirect()->route('units.index');
    }

    public function archived(Unit $unit)
    {
    	$data = request()->validate(['archived' => 'required']);

    	$unit->update($data);

    	return redirect()->route('units.index');
    }

    public function destroy(Unit $unit)
    {
    	$unit->delete();

    	return redirect()->route('units.index');
    }

}
