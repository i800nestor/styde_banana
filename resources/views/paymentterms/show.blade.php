@extends('mother')

@section('title', "Payment Term - {$payment_term->name}")

@section('content')

	<div class="card bg-light mb-3" style="max-width: 18rem;">
		<div class="card-header">{{ $payment_term->name }}</div>
		<div class="card-body">
	 		<p class="card-text">
	 			{{ $payment_term->notes }}
	 		</p>
		</div>
	</div>

	<p>
		<a href="{{ route('term_types.new', $payment_term->id) }}" class="btn btn-primary">
			New Term Type
		</a>
	</p>

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
				    <th scope="col">Action</th>
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
						<td>
							<form action="{{ url("term_types/{$term->id}") }}" method="POST">
								{{ csrf_field() }}
								{{ method_field('DELETE') }}

								<a href="{{ url("term_types/{$payment_term->id}/{$term->id}/edit") }}" class="btn btn-link">
									<span class="oi oi-pencil"></span>
								</a>

								<button type="submit" class="btn btn-link"><span class="oi oi-trash"></span></button>
							</form>
						</td>
					</tr>

				@endforeach

			</tbody>
		</table>
		{{ $term_type->links() }}

	@else

		<p>No Terms Types registered.</p>

	@endif
	
	
	
	<p>
		<a href="{{ route('payment_terms.index') }}">
			Return to the list of payment term
		</a>
	</p>
@endsection