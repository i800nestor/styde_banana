@extends('mother')

@section('title', "country")

@section('content')
	<h1>
		Country #{{ $country->id }} <br>
		{{ $country->country }}, {{$country->iso}}

	</h1>
	
	<p>
		<a href="{{ route('countries.index') }}">
			Return to the list of countries
		</a>
	</p>
@endsection