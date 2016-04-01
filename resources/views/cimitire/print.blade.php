@extends('layouts.print')
@section('header')
<div id="header">
	<h1 align="center">Lista Cimitire</h1>
</div>

@endsection
@section('content')
<div id="cimitire">
	<table>
		<tr>
	    	<th>Nume</th>
	    	<th>Adresa</th>
	    	<th>Nr parcele</th>
	    	<th>data creare</th>
	  	</tr>
	  	@foreach($cimitire as $cimitir) 
	        	  <tr>
	        	  	<td>{{$cimitir->nume}}</td>
	        	  	<td>{{$cimitir->adresa}}</td>
	        	  	<td>{{$cimitir->parcele->count()}}</td>
	        	  	<td>{{$cimitir->created_at}}</td>
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