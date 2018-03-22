@extends('mother')

@section('title', "Show States")

@section('content')

	<div class="d-flex justify-content-between align-items-end mb-2">
		
		<h1 class="pb-1">Registered states</h1>
		<p>
			<a href="{{ route('states.new') }}" class="btn btn-primary">
				create new states
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

	@if ( $states->isNotEmpty() )

		<table class="table table-hover">
			<thead>
				<tr>
					<th scope="col"># State</th>
					<th scope="col"># Country</th>
					<th scope="col">Iso</th>
					<th scope="col">State</th>
					<th scope="col">Archived</th>
					<th scope="col">Action</th>
				</tr>
		  	</thead>
			<tbody>

				@foreach ($states as $state)

					<tr>
						<th scope="row">{{ $state->id }}</th>
						<td>{{ $state->country_id }}</td>
						<td>{{ $state->iso }}</td>
						<td>{{ $state->state }}</td>
						<td>{{ $state->archived }}</td>
						<td>

							<form action="{{ route('states.archived', $state) }}" method="POST">
								{{ csrf_field() }}
								{{ method_field('PUT') }}
								<input type="hidden" name="archived" id="archived" value=<?php
									$archived = ( $state->archived == 0 ) ? 1 : 0;
									echo $archived;
								?>>

								<button type="submit" class="btn btn-link">archived</button>
							</form>

							<form action="{{ route('states.delete', $state) }}" method="POST">
								{{ csrf_field() }}
								{{ method_field('DELETE') }}

								<a href="{{ route('states.edit', $state) }}" class="btn btn-link">
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

		<p>No states registered.</p>

	@endif

@endsection