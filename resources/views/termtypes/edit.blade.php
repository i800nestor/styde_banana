@extends('mother')

@section('title', "Edit Term Type - {$payment_term->name}")

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
		Edit Term Type
	</h4>

		<div class="table-responsive">
			<table class="table">
				<tbody>

					<form method="POST" action="{{ url("term_types/{$term_type->id}") }}">
						{{ csrf_field() }}
						{{ method_field('PUT') }}

						<input type="hidden" name="payment_terms_id" id="payment_terms_id" value="{{ $payment_term->id }}">

						<tr>
							<td>Type</td>
							<td>
								<select name="type" id="type">

									<option value="{{ old('type', $term_type->type) }}">{{ old('type', $term_type->type) }}</option>
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
								<input type="radio" name="typev" id="typeid" value=typeid
								
								@if ( $term_type->typeid == 1 )
									checked 
								@endif

								>
								<label for="typeid">Type-ID</label>
								<br>
								<input type="radio" name="typev" id="typeem" value=typeem
								
								@if ( $term_type->typeem == 1 )
									checked 
								@endif
								
								>
								<label for="typeem">Type-EM</label>
								<br>
								<input type="radio" name="typev" id="typenm" value=typenm
								
								@if ( $term_type->typenm == 1 )
									checked 
								@endif
								
								>
								<label for="typenm">Type-NM</label>
							</td>							
						</tr>
						<tr>
							<td>Days</td>
							<td>
								<input type="number" name="day" id="day" value="{{ old('day', $term_type->day) }}">
							</td>							
						</tr>
						<tr>
							<td>
								Fixed amount
							</td>
							<td>
								<input type="number" name="fixed_amount" id="fixed_amount" value="{{ old('fixed_amount', $term_type->fixed_amount) }}">
							</td>
						</tr>
						<tr>
							<td>
								Percentage
							</td>
							<td>
								<input type="number" name="percentage" id="percentage" value="{{ old('percentage', $term_type->percentage) }}">
							</td>
						</tr>
						<tr>
							<td>
								days for early payment
							</td>
							<td>
								<input type="number" name="daydxpp" id="daydxpp" value="{{ old('daydxpp', $term_type->daydxpp) }}">
							</td>
							<td>
								discount for prompt payment
							</td>
							<td>
								<input type="number" name="percentdxpp" id="percentdxpp" value="{{ old('percentdxpp', $term_type->percentdxpp) }}">
							</td>
						</tr>
						<tr>
							<td>
								<button type="submit" class="btn btn-primary">Edit Term Type</button>
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