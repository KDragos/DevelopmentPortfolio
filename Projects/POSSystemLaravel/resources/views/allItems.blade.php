@extends('layout')

This is my item page.

@section('main_content')
<table>
	<tr>
		<td>Item Name</td>
		<td>Price</td>
	</tr>
	
	@foreach($data as $item)
	<tr>
		<li>{{ $item->name }} </li>
		<li>{{ $item->price }} </li>
	</tr>
	@endforeach


{{-- 	@for ($i = 0; $i < 10; $i++)
  	  The current value is {{ $i }}
	@endfor --}}

</table>
@stop