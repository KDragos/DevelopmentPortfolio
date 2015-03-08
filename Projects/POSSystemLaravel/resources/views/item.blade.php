@extends('layout')

This is my item page.

@section('main_content')
<h2>Our Inventory Items</h2>
<table border='1'>
	<tr>
		<td>Item Name</td>
		<td>Price</td>
	</tr>
	
	@foreach($items as $item)
	<tr>
		<td>{{ $item->name }}</td>
		<td>{{ $item->price }} </td>
	</tr>
	@endforeach

</table>
@stop