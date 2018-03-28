@extends('mother')

@section('title', "Create Unit")

@section('content')

	<div class="card">

		<h4 class="card-header">
			Create new unit
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

			<form method="POST" action="{{ url('units/create') }}">
				{{ csrf_field() }}

				<div class="input-group input-group-sm">
				  
				  <div class="input-group-prepend">
				    <span class="input-group-text" id="inputGroup-sizing-sm">Tag</span>
				  </div>

				  <input type="text" name="tag" id="tag" placeholder="Byte"
				  value="{{ old('tag') }}" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm">

				</div>
				<br>

				<div class="input-group input-group-sm">
				  
				  <div class="input-group-prepend">
				    <span class="input-group-text" id="inputGroup-sizing-sm">Quantity</span>
				  </div>

				  <input type="number" name="quantity" id="quantity" placeholder=1 value="{{ old('quantity') }}"
				   class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm">

				</div>
				<br>

				<button type="submit" class="btn btn-primary">Create Unit</button>
				<a href="{{ route('units.index') }}" class="btn btn-link">
					Return to the list of units
				</a>
			</form>

		</div>

	</div>

@endsection