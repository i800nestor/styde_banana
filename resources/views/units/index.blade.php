@extends('mother')

@section('title', "Show Units")

@section('content')

	<div class="d-flex justify-content-between align-items-end mb-2">
		
		<h1 class="pb-1">Registered units</h1>
		<p>
			<a href="{{ route('units.new') }}" class="btn btn-primary">
				create new unit
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

	@if ( $units->isNotEmpty() )

		<table class="table table-hover">
			<thead>
				<tr>
					<th scope="col">#</th>
					<th scope="col">Tag</th>
					<th scope="col">Quantity</th>
					<th scope="col">Archived</th>
					<th scope="col">Action</th>
				</tr>
		  	</thead>
			<tbody>

				@foreach ($units as $unit)

					<tr>
						<th scope="row">{{ $unit->id }}</th>
						<td>{{ $unit->tag }}</td>
						<td>{{ number_format($unit->quantity, 2, '.', ',') }}</td>
						<td>{{ $unit->archived }}</td>
						<td>

							<form action="{{ route('units.archived', $unit) }}" method="POST">
								{{ csrf_field() }}
								{{ method_field('PUT') }}
								<input type="hidden" name="archived" id="archived" value=<?php
									$archived = ( $unit->archived == 0 ) ? 1 : 0;
									echo $archived;
								?>>

								<button type="submit" class="btn btn-link">archived</button>
							</form>

							<form action="{{ route('units.delete', $unit) }}" method="POST">
								{{ csrf_field() }}
								{{ method_field('DELETE') }}

								<a href="{{ route('units.edit', $unit) }}" class="btn btn-link">
									<span class="oi oi-pencil"></span>
								</a>

								<button type="submit" class="btn btn-link"><span class="oi oi-trash"></span></button>
							</form>
						</td>
					</tr>

				@endforeach

			</tbody>
		</table>
		{{ $units->links() }}

	@else

		<p>No units registered.</p>

	@endif

@endsection