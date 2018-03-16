@extends('mother')

@section('title', "Edit Country")

@section('content')

	<div class="card">

		<h4 class="card-header">
			Edit country
		</h4>

		<div class="card-body">
			
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
				{{ csrf_field() }}
				{{ method_field('PUT') }}

				<div class="input-group input-group-sm">
				  
				  <div class="input-group-prepend">
				    <span class="input-group-text" id="inputGroup-sizing-sm">Iso</span>
				  </div>

				  <input type="text" name="iso" id="iso" placeholder="ve"
				  value="{{ old('iso', $country->iso) }}" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm">

				</div>
				<br>

				<div class="input-group input-group-sm">
				  
				  <div class="input-group-prepend">
				    <span class="input-group-text" id="inputGroup-sizing-sm">Country</span>
				  </div>

				  <input type="text" name="country" id="country" placeholder="venezuela" value="{{ old('country', $country->country) }}"
				   class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm">

				</div>
				<br>

				<button type="submit" class="btn btn-primary">Edit Country</button>
				<a href="{{ route('countries.index') }}" class="btn btn-link">
					Return to the list of countries
				</a>
			</form>

		</div>

	</div>

@endsection