@extends('mother')

@section('title', "Create City")

@section('content')

	<div class="card">

		<h4 class="card-header">
			Create new city
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

			<form method="POST" action="{{ url('cities/create') }}">
				{{ csrf_field() }}

				<label for='state_id'>State</label>
				<select name="state_id" id="state_id">
					<option>Select</option>

					@foreach ($states as $state)

						<option value="{{ $state->id }}">
							{{ $state->state }}
						</option>

					@endforeach

				</select>
				<br>

				<div class="input-group input-group-sm">
				  
				  <div class="input-group-prepend">
				    <span class="input-group-text" id="inputGroup-sizing-sm">City</span>
				  </div>

				  <input type="text" name="city" id="city" placeholder="caracas" value="{{ old('city') }}"
				   class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm">

				</div>
				<br>

				<label for="capital">capital</label>
				<input type="checkbox" name="capital" id="capital" value="{{
					old('capital', 1)
				}}">
				<br>

				<button type="submit" class="btn btn-primary">Create City</button>
				<a href="{{ route('cities.index') }}" class="btn btn-link">
					Return to the list of cities
				</a>
			</form>

		</div>

	</div>

@endsection