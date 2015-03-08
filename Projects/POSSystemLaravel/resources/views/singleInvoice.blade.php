@extends('layout')

@section('main_content')
	<div>
		<h2>Invoice: {{ $invoice_id }}</h2>

    	<table border=1>
	    	<tr>
	    		<th>Item Name</th>
	    		<th>Price</th>
	    		<th>Quantity</th>
	    		<th>Line Total</th>
	    		<th>Delete?</th>
			</tr>
		@foreach($invoices as $invoice)
	    	<tr>
	    		<td>{{ $invoice->name }}</td>
	    		<td>{{ $invoice->price }}</td>
	    		<td>{{ $invoice->quantity }}</td>
	    		<td>{{ $invoice->lineTotal }}</td>
	    		<td><a href="/removeInvoiceItem/{{$invoices[0]->invoice_id}}/{{$invoice->item_id}}">Delete</a></td>
	    	</tr>
		@endforeach
			<tr>
				<td></td>
				<td></td>
				<td>Total:</td>
				<td>{{ $tableTotal }}</td>
			</tr>
    	</table>

		<form action="/editInvoice/{{ $invoice_id }}" method="POST">
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
 		<input type="number" name="quantity" min="0">
		<select name="item_id">
			@foreach ($items as $item)
				<option value="{{ $item->item_id }}">{{ $item->name }}</option>
			@endforeach
		</select>	
		<button>Add to Invoice</button>
		</form>

	</div>

@endsection