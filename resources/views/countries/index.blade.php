@extends('mother')

@section('title', "Show Countries")

@section('content')
	<h1>Registered countries</h1>

	<ul>
		@forelse ($countries as $country)

			<li>{{ $country->iso }}, {{ $country->country }}</li>

		@empty

			<p>No countries registered.</p>

		@endforelse
	</ul>
@endsection