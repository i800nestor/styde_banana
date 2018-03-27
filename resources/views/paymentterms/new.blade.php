@extends('mother')

@section('title', "Create Payment Term")

@section('content')

	<div class="card">

		<h4 class="card-header">
			Create new payment term
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

			<form method="POST" action="{{ url('payment_terms/create') }}">
				{{ csrf_field() }}

				<div class="input-group input-group-sm">
				  
				  <div class="input-group-prepend">
				    <span class="input-group-text" id="inputGroup-sizing-sm">Name</span>
				  </div>

				  <input type="text" name="name" id="name" placeholder="Name of payment method"
				  value="{{ old('name') }}" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm">

				</div>
				<br>

				<div class="form-group">
				    <label for="notes">Notes</label>
				    <textarea class="form-control" name="notes" id="notes" placeholder="Payment method notes"  rows="3">{{ old('notes') }}</textarea>
  				</div>

				<br>

				<button type="submit" class="btn btn-primary">Create Payment Term</button>
				<a href="{{ route('payment_terms.index') }}" class="btn btn-link">
					Return to the list of paymet terms
				</a>
			</form>

		</div>

	</div>

@endsection