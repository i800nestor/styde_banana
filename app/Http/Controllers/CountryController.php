<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Country;

class CountryController extends Controller
{
    public function index()
    {
    	$countries = Country::all();

    	//dd($countries);

    	return view('countries.index', compact(
    		'countries'
    	));
    }
}
