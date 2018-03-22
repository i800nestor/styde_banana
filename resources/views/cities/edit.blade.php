@extends('mother')

@section('title', "Edit City")

@section('content')

	<div class="card">

		<h4 class="card-header">
			Edit city
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

			<form method="POST" action="{{ url("cities/{$city->id}") }}">
				{{ csrf_field() }}
				{{ method_field('PUT') }}

				<label for='state_id'>State</label>
				<select name="state_id" id="state_id">
					
					<?php $find = false ?>
					
					@foreach ($states as $state)


						@if ( old('state_id', $city->state_id) == $state->id )

							<option value="{{ old('state_id', $city->state_id)}}" >
								{{ $state->state }}
							</option>

							<?php $find = true ?>

							@break

						@endif

					@endforeach

					@if (!$find)

						<option></option>

					@endif

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

				  <input type="text" name="city" id="city" placeholder="caracas" value="{{ old('city', $city->city) }}"
				   class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm">

				</div>
				<br>

				<p>capital</p>

				<input type="radio" name="capital" id="capital_not" value=0

				@if ( !$city->capital )
					checked
				@endif

				>

				<label for="capital_not">Not</label>

				<input type="radio" name="capital" id="capital_yes" value=1

				@if ( $city->capital )
					checked
				@endif

				>
				<label for="capital_yes">Yes</label>
				<br>

				<button type="submit" class="btn btn-primary">Edit City</button>
				<a href="{{ route('cities.index') }}" class="btn btn-link">
					Return to the list of cities
				</a>
			</form>

		</div>

	</div>

@endsection