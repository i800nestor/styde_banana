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

	@if ( count($cities) )

		<table class="table table-hover">
			<thead>
				<tr>
					<th scope="col"># City</th>
					<th scope="col">State</th>
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
						<td>{{ $city->state }}</td>
						<td>{{ $city->city }}</td>
						<td>{{ $city->capital }}</td>
						<td>{{ $city->archived }}</td>
						<td>

							<form action="{{ route('cities.archived', $city->id) }}" method="POST">
								{{ csrf_field() }}
								{{ method_field('PUT') }}
								<input type="hidden" name="archived" id="archived" value=<?php
									$archived = ( $city->archived == 0 ) ? 1 : 0;
									echo $archived;
								?>>

								<button type="submit" class="btn btn-link">archived</button>
							</form>

							<form action="{{ route('cities.delete', $city->id) }}" method="POST">
								{{ csrf_field() }}
								{{ method_field('DELETE') }}

								<a href="{{ route('cities.edit', $city->id) }}" class="btn btn-link">
									<span class="oi oi-pencil"></span>
								</a>

								<button type="submit" class="btn btn-link"><span class="oi oi-trash"></span></button>
							</form>
						</td>
					</tr>

				@endforeach

			</tbody>
		</table>

	@else

		<p>No cities registered.</p>

	@endif

@endsection