@extends('mother')

@section('title', "Create Country")

@section('content')
	<h1>Create new country</h1>

	@if ( $errors->any() )

		<div class="alert alert-danger">
			<p>please correct the errors</p>
			{{--
			<ul>
				@foreach ($errors->all() as $error)

					<li>{{ $error }}</li>

				@endforeach
			</ul>
			--}}
		</div>

	@endif

	<form method="POST" action="{{ url('countries/create') }}">
		{{ csrf_field() }}

		<label for="iso">Iso:</label>
		<input type="text" name="iso" id="iso" placeholder="ve"
		value="{{ old('iso') }}">

		@if ( $errors->has('iso') )

			<p>{{ $errors->first('iso') }}</p>

		@endif
		<br>

		<label for="country">Country:</label>
		<input type="text" name="country" id="country" placeholder="venezuela" value="{{ old('country') }}">

		@if ( $errors->has('country') )

			<p>{{ $errors->first('country') }}</p>

		@endif

		<br>
		<button type="submit">Create Country</button>
	</form>

	<p>
		<a href="{{ route('countries.index') }}">
			Return to the list of countries
		</a>
	</p>
@endsection