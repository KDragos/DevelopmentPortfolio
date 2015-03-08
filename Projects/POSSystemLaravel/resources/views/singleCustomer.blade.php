@extends('layout')

@section('main_content')
	<div>
		<h2>Profile for {{ $customer->first_name }} {{ $customer->last_name}}!</h2>
		<p>First Name: {{ $customer->first_name }}</p>
    	<p>Last Name: {{ $customer->last_name }}</p>
    	<p>Email: {{ $customer->email }}</p>
    	<p>Gender: {{ $customer->gender }}</p>
    	<p>Customer Since: {{ $customer->customer_since }}</p>  
		</div>
	<div>
		<h2>Options</h2>
		<a href="">Edit Profile</a>
		<a href="">Delete Customer</a>
	</div>
	<div>
		<h2>Invoice History</h2>	
		<a href="/addInvoice/{{$customer->customer_id}}">Create New Invoice</a>

	</div>
@endsection