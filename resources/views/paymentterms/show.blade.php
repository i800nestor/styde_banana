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
	
	<table class="table table-sm">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">First</th>
      <th scope="col">Last</th>
      <th scope="col">Handle</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">1</th>
      <td>Mark</td>
      <td>Otto</td>
      <td>@mdo</td>
    </tr>
  </tbody>
</table>
	
	<p>
		<a href="{{ route('payment_terms.index') }}">
			Return to the list of payment term
		</a>
	</p>
@endsection