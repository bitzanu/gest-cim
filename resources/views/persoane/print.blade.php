@extends('layouts.print')
@section('header')
<div id="header">
	<h1 align="center">Lista Persoane</h1>
</div>

@endsection
@section('content')
<div id="persoane">
	<table>
		<tr>
	    	<th>Nume Prenume</th>
	    	<th>Adresa</th>
	    	<th>CNP</th>
	    	<th>Nr concesiuni</th>
	    	<th>data creare</th>
	  	</tr>
	  	@foreach($persoane as $persoana) 
	        	  <tr>
	        	  	<td>{{$persoana->nume}} {{$persoana->prenume}}</td>
	        	  	<td>{{$persoana->adresa}}</td>
	        	  	<td>{{$persoana->CNP}}</td>
	        	  	<td>{{$persoana->concesiuni->count()}}</td>
	        	  	<td>{{$persoana->created_at}}</td>
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