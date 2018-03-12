@extends('mother')

@section('title', "Edit Country")

@section('content')
	<h1>Edit country</h1>

	@if ( $errors->any() )

		<div class="alert alert-danger">
			<p>please correct the errors</p>
			<ul>
				@foreach ($errors->all() as $error)

					<li>{{ $error }}</li>

				@endforeach
			</ul>
		</div>

	@endif

	<form method="POST" action="{{ url("countries/{$country->id}") }}">
		{{ method_field('PUT') }}
		{{ csrf_field() }}

		<label for="iso">Iso:</label>
		<input type="text" name="iso" id="iso" placeholder="ve"
		value="{{ old('iso', $country->iso) }}">
		<br>

		<label for="country">Country:</label>
		<input type="text" name="country" id="country" placeholder="venezuela" value="{{ old('country', $country->country) }}">
		<br>

		<button type="submit">Edit Country</button>
	</form>

	<p>
		<a href="{{ route('countries.index') }}">
			Return to the list of countries
		</a>
	</p>
@endsection