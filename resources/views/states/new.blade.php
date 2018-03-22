@extends('mother')

@section('title', "Create State")

@section('content')

	<div class="card">

		<h4 class="card-header">
			Create new state
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

			<form method="POST" action="{{ url('states/create') }}">
				{{ csrf_field() }}

				<label for='country_id'>Country</label>
				<select name="country_id" id="country_id">

					<?php $find = false ?>
					
					@foreach ($countries as $country)


						@if ( old('country_id') == $country->id )

							<option value="{{ old('country_id')}}" >
								{{ $country->country }}
							</option>

							<?php $find = true ?>

							@break

						@endif

					@endforeach

					@if (!$find)

						<option></option>

					@endif

					@foreach ($countries as $country)

						<option value="{{ $country->id }}">
							{{ $country->country }}
						</option>

					@endforeach

				</select>
				<br>

				<div class="input-group input-group-sm">

					<div class="input-group-prepend">
				    	<span class="input-group-text" id="inputGroup-sizing-sm">Iso</span>
				 	</div>


				 	<input type="text" name="iso" id="iso" placeholder="mir" value="{{ old('iso') }}"
				   class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
				  
				</div>
				<br>

				<div class="input-group input-group-sm">

				 	<div class="input-group-prepend">
				    	<span class="input-group-text" id="inputGroup-sizing-sm">State</span>
				 	</div>

				 	<input type="text" name="state" id="state" placeholder="miranda" value="{{ old('state') }}"
				   class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm">

				</div>
				<br>


				<button type="submit" class="btn btn-primary">Create City</button>
				<a href="{{ route('states.index') }}" class="btn btn-link">
					Return to the list of states
				</a>
			</form>

		</div>

	</div>

@endsection