@extends('mother')

@section('title', "Show Payment Terms")

@section('content')

	<div class="d-flex justify-content-between align-items-end mb-2">
		
		<h1 class="pb-1">Registered Payment Terms</h1>
		<p>
			<a href="{{ route('payment_terms.new') }}" class="btn btn-primary">
				New Payment Term
			</a>
		</p>

	</div>

	@if ( isset($error_message) && $_GET['e'] == 'true' )

		<div class="alert alert-danger">
			<p>{{ $error_message }}</p>
		</div>

	@endif

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

	@if ( $payment_terms->isNotEmpty() )

		<table class="table table-hover">
			<thead>
				<tr>
					<th scope="col">#</th>
					<th scope="col">Name</th>
					<th scope="col">Action</th>
				</tr>
		  	</thead>
			<tbody>

				@foreach ($payment_terms as $payment_term)

					<tr>
						<th scope="row">{{ $payment_term->id }}</th>
						<td>{{ $payment_term->name }}</td>
						<td>
							<a href="{{ route('payment_terms.show', $payment_term) }}">
								See details
							</a>
							<form action="{{ url("payment_terms/{$payment_term->id}") }}" method="POST">
								{{ csrf_field() }}
								{{ method_field('DELETE') }}

								<a href="{{ url("payment_terms/{$payment_term->id}/edit") }}" class="btn btn-link">
									<span class="oi oi-pencil"></span>
								</a>

								<button type="submit" class="btn btn-link"><span class="oi oi-trash"></span></button>
							</form>
						</td>
					</tr>

				@endforeach

			</tbody>
		</table>
		{{ $payment_terms->links() }}

	@else

		<p>No Payment Terms registered.</p>

	@endif

@endsection