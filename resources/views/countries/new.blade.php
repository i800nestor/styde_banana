@extends('mother')

@section('title', "Create Country")

@section('content')

	<div class="card">

		<h4 class="card-header">
			Create new country
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

			<form method="POST" action="{{ url('countries/create') }}">
				{{ csrf_field() }}

				<div class="input-group input-group-sm">
				  
				  <div class="input-group-prepend">
				    <span class="input-group-text" id="inputGroup-sizing-sm">Iso</span>
				  </div>

				  <input type="text" name="iso" id="iso" placeholder="ve"
				  value="{{ old('iso') }}" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm">

				</div>
				<br>

				<div class="input-group input-group-sm">
				  
				  <div class="input-group-prepend">
				    <span class="input-group-text" id="inputGroup-sizing-sm">Country</span>
				  </div>

				  <input type="text" name="country" id="country" placeholder="venezuela" value="{{ old('country') }}"
				   class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm">

				</div>
				<br>

				<button type="submit" class="btn btn-primary">Create Country</button>
				<a href="{{ route('countries.index') }}" class="btn btn-link">
					Return to the list of countries
				</a>
			</form>

		</div>

	</div>

@endsection