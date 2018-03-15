@extends('mother')

@section('title', "Show Countries")

@section('content')
	<h1>Registered countries</h1>

	<a href="{{ route('countries.new') }}">
		create new country
	</a>

	<ul>
		@forelse ($countries as $country)

			<li>
				#{{ $country->id }} {{ $country->country }}, {{ $country->iso }}.
				<a href="{{ route('countries.edit', $country) }}">
					Edit 
				</a> |
				<form action="{{ route('countries.delete', $country) }}" method="POST">
					{{ csrf_field() }}
					{{ method_field('DELETE') }}

					<button type="submit">Delete</button>
				</form>
			</li>

		@empty

			<p>No countries registered.</p>

		@endforelse
	</ul>
@endsection