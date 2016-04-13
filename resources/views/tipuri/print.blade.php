@extends('layouts.print')
@section('header')
<div id="header">
	<h1 align="center">Lista tipuri concesiuni</h1>
</div>

@endsection
@section('content')
<div id="concesiuni">
	<table>
		<tr>
	    	<th>Nume</th>
	    	<th>Procent reducere</th>
	    	<th>Nr concesiuni</th>
	    	<th>data creare</th>
	  	</tr>
	  	@foreach($tipuri as $tip) 
	        	  <tr>
	        	  	<td>{{$tip->nume}}</td>
	        	  	<td>{{$tip->reducere}}</td>
	        	  	<td>{{$tip->concesiuni->count()}}</td>
	        	  	<td>{{$tip->created_at}}</td>
	        	  </tr>
	   			@endforeach  


	</table>
</div>

@endsection

@section('footer')
<div id="footer">
	<h3>Data:______________</h3>
	<h3>Semnatura______________</h3>
</div>

@endsection