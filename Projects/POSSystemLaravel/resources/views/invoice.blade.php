@extends('layout')

@section('main_content')
<h1>Invoices</h1>

<table border=1>
	<tr>
    	<th>Invoice Id</th>
    	<th>First Name</th>
    	<th>Last Name</th>
    	<th>Total</th>
    	<th>Details</th>
    	<th>Delete?</th>
	</tr>
@foreach ($invoices as $invoice)
    <tr>
    	<td>{{ $invoice->invoice_id }}</td>
    	<td>{{ $invoice->first_name }}</td>
    	<td>{{ $invoice->last_name }}</td>
    	<td>{{ $invoice->total }}</td>
    	<td><a href="/singleInvoice/{{$invoice->invoice_id}}">Details</a></td>
    	<td><a href="/deleteInvoice/{{$invoice->invoice_id}}">Delete</a></td>
	</tr>
@endforeach
</table>
@endsection