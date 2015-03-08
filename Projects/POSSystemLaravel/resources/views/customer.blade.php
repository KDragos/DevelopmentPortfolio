@extends('layout')

@section('main_content')
<h1>Customers</h1>

<table border=1>
	<tr>
    	<th>First Name</th>
    	<th>Last Name</th>
    	<th>Email</th>
    	<th>Details</th>
	</tr>
@foreach ($customers as $customer)
    <tr>
    	<td>{{ $customer->first_name }}</td>
    	<td>{{ $customer->last_name }}</td>
    	<td>{{ $customer->email }}</td>
    	<td><a href="/singleCustomer/{{$customer->customer_id}}">Details</a></td>
	</tr>
@endforeach
</table>
@endsection