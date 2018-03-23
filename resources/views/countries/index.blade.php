@extends('mother')

@section('title', "Show Countries")

@section('content')

	<div class="d-flex justify-content-between align-items-end mb-2">
		
		<h1 class="pb-1">Registered countries</h1>
		<p>
			<a href="{{ route('countries.new') }}" class="btn btn-primary">
				create new country
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

	@if ( $countries->isNotEmpty() )

		<table class="table table-hover">
			<thead>
				<tr>
					<th scope="col">#</th>
					<th scope="col">Iso</th>
					<th scope="col">Country</th>
					<th scope="col">Archived</th>
					<th scope="col">Action</th>
				</tr>
		  	</thead>
			<tbody>

				@foreach ($countries as $country)

					<tr>
						<th scope="row">{{ $country->id }}</th>
						<td>{{ $country->iso }}</td>
						<td>{{ $country->country }}</td>
						<td>{{ $country->archived }}</td>
						<td>

							<form action="{{ route('countries.archived', $country) }}" method="POST">
								{{ csrf_field() }}
								{{ method_field('PUT') }}
								<input type="hidden" name="archived" id="archived" value=<?php
									$archived = ( $country->archived == 0 ) ? 1 : 0;
									echo $archived;
								?>>

								<button type="submit" class="btn btn-link">archived</button>
							</form>

							<form action="{{ route('countries.delete', $country) }}" method="POST">
								{{ csrf_field() }}
								{{ method_field('DELETE') }}

								<a href="{{ route('countries.edit', $country) }}" class="btn btn-link">
									<span class="oi oi-pencil"></span>
								</a>

								<button type="submit" class="btn btn-link"><span class="oi oi-trash"></span></button>
							</form>
						</td>
					</tr>

				@endforeach

			</tbody>
		</table>
		{{ $countries->links() }}

	@else

		<p>No countries registered.</p>

	@endif

@endsection