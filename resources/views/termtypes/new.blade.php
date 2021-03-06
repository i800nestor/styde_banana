@extends('mother')

@section('title', "New Term Type - {$payment_term->name}")

@section('content')

	<div class="card bg-light mb-3" style="max-width: 18rem;">
		<div class="card-header">{{ $payment_term->name }}</div>
		<div class="card-body">
	 		<p class="card-text">
	 			{{ $payment_term->notes }}
	 		</p>
		</div>
	</div>

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

	<h4 class="card-header">
		Create term type
	</h4>

		<div class="table-responsive">
			<table class="table">
				<tbody>

					<form method="POST" action="{{ url('term_types/create') }}">
						{{ csrf_field() }}
						<input type="hidden" name="payment_terms_id" id="payment_terms_id" value="{{ $payment_term->id }}">

						<tr>
							<td>Type</td>
							<td>
								<select name="type" id="type">

									<option value="{{ old('type') }}">{{ old('type') }}</option>
									<option value="M">Fixed amount</option>
									<option value="B">Balance</option>
									<option value="P">Percentage</option>

								</select>
							</td>
						</tr>
						<tr>
							<td>
								Type expiration
							</td>
							<td>
								<input type="radio" name="typev" id="typedays" value="typedays" checked>
								<label for="typedays">Days</label>
								<br>
								<input type="radio" name="typev" id="typeid" value=typeid>
								<label for="typeid">Type-ID</label>
								<br>
								<input type="radio" name="typev" id="typeem" value=typeem>
								<label for="typeem">Type-EM</label>
								<br>
								<input type="radio" name="typev" id="typenm" value=typenm>
								<label for="typenm">Type-NM</label>
							</td>							
						</tr>
						<tr>
							<td>Days</td>
							<td>
								<input type="number" name="day" id="day" value="{{ old('day') }}">
							</td>							
						</tr>
						<tr>
							<td>
								Fixed amount
							</td>
							<td>
								<input type="number" name="fixed_amount" id="fixed_amount" value="{{ old('fixed_amount') }}">
							</td>
						</tr>
						<tr>
							<td>
								Percentage
							</td>
							<td>
								<input type="number" name="percentage" id="percentage" value="{{ old('percentage') }}">
							</td>
						</tr>
						<tr>
							<td>
								days for early payment
							</td>
							<td>
								<input type="number" name="daydxpp" id="daydxpp" value="{{ old('daydxpp') }}">
							</td>
							<td>
								discount for prompt payment
							</td>
							<td>
								<input type="number" name="percentdxpp" id="percentdxpp" value="{{ old('percentdxpp') }}">
							</td>
						</tr>
						<tr>
							<td>
								<button type="submit" class="btn btn-primary">Create Term Type</button>
							</td>
						</tr>

					</form>

				</tbody>
			</table>
		</div>	
	
	<p>
		<a href="{{ route('payment_terms.show', $payment_term->id) }}">
			Return to the payment term
		</a>
	</p>
@endsection