@extends('layouts.print')
@section('header')
<div id="header">
	<h1 align="center">Lista Concesiuni</h1>
</div>

@endsection
@section('content')
<div id="concesiuni">
	<table>
		<tr>
	    	<th>Numar</th>
	    	<th>An</th>
	    	<th>Durata</th>
	    	<th>Cimitir</th>
	    	<th>Parcela</th>
	    	<th>Loc</th>
	    	<th>Nr rate</th>
	    	<th>Persoane</th>

	  	</tr>
	  	@foreach($concesiuni as $concesiune) 
	        	  <tr>
	        	  	<td>{{$concesiune->numar}}</td>
	        	  	<td>{{$concesiune->tarif->an}}</td>
	        	  	<td>{{$concesiune->durata}}</td>
	        	  	<td>{{$concesiune->loc->parcela->cimitir->nume}}</td>
	        	  	<td>{{$concesiune->loc->parcela->numar}}</td>
	        	  	<td>{{$concesiune->loc->numar}}</td>
	        	  	<td>{{$concesiune->rate->count()}}</td>
	        	  	<td>

	        	  		@foreach($concesiune->persoane as $persoana)
	        	  		 {{$persoana->nume}},{{$persoana->prenume}}
	        	  		 <br>  
	        	  		@endforeach
	        	  	</td>
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