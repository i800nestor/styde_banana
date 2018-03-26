@extends('mother')

@section('title', "Payment Term - {$payment_term->name}")

@section('content')

	<div class="card bg-light mb-3" style="max-width: 18rem;">
		<div class="card-header">Payment Term</div>
		<div class="card-body">
			<h5 class="card-title">{{ $payment_term->name }}</h5>
	 		<p class="card-text">
	 			{{ $payment_term->notes }}
	 		</p>
		</div>
	</div>

	@if ( $term_type->isNotEmpty() )

		<table class="table">
		<thead>
	 		<tr>
			    <th scope="col">Type</th>
			    <th scope="col">Days</th>
			    <th scope="col">invoice date</th>
			    <th scope="col">the last day of month</th>
			    <th scope="col">the last day of next month</th>
			    <th scope="col">Discount days</th>
			    <th scope="col">Discount percentage</th>
			    <th scope="col">Fixed amount</th>
			    <th scope="col">Percentage</th>
	 		</tr>
		</thead>
		<tbody>

			@foreach ( $term_type as $term )

				<tr>
					<th scope="row">{{ $term->type }}</th>
					<td>{{ $term->day }}</td>
					<td>{{ $term->typeid }}</td>
					<td>{{ $term->typeem }}</td>
					<td>{{ $term->typenm }}</td>
					<td>{{ $term->daydxpp }}</td>
					<td>{{ $term->percentdxpp }}</td>
					<td>{{ number_format($term->fixed_amount, 2, '.', ',') }}</td>
					<td>{{ $term->percentage }}%</td>
				</tr>

			@endforeach
		</tbody>
	</table>

	@else

		<p>No Terms Types registered.</p>

	@endif
	
	
	
	<p>
		<a href="{{ route('payment_terms.index') }}">
			Return to the list of payment term
		</a>
	</p>
@endsection