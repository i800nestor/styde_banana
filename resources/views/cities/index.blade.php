@extends('mother')

@section('title', "Show Cities")

@section('content')

	<div class="d-flex justify-content-between align-items-end mb-2">
		
		<h1 class="pb-1">Registered countries</h1>
		<p>
			<a href="{{ route('cities.new') }}" class="btn btn-primary">
				create new city
			</a>
		</p>

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

	@if ( $cities->isNotEmpty() )

		<table class="table table-hover">
			<thead>
				<tr>
					<th scope="col"># City</th>
					<th scope="col"># State</th>
					<th scope="col">City</th>
					<th scope="col">Capital</th>
					<th scope="col">Archived</th>
					<th scope="col">Action</th>
				</tr>
		  	</thead>
			<tbody>

				@foreach ($cities as $city)

					<tr>
						<th scope="row">{{ $city->id }}</th>
						<td>{{ $city->state_id }}</td>
						<td>{{ $city->city }}</td>
						<td>{{ $city->capital }}</td>
						<td>{{ $city->archived }}</td>
						<td>

						</td>
					</tr>

				@endforeach

			</tbody>
		</table>

	@else

		<p>No cities registered.</p>

	@endif

@endsection