@extends('layouts.print')
@section('header')
<div id="header">
	<h1 align="center">Lista Locuri</h1>
</div>

@endsection
@section('content')
<div id="parcele">
	<table>
		<tr>
	    	<th>Cimitir</th>
	    	<th>Parcela</th>
	    	<th>Numar</th>
	    	<th>Nr locuri</th>
	    	<th>Dimensiuni</th>
	    	<th>Constructie</th>
	  	</tr>
	  	@foreach($locuri as $loc) 
	        	  <tr>
	        	  	<td>{{$loc->parcela->cimitir->nume}}</td>
	        	  	<td>{{$loc->parcela->numar}}</td>
	        	  	<td>{{$loc->numar}}</td>
	        	  	<td>{{$loc->numar_locuri}}</td>
	        	  	<td>{{$loc->lungime}},{{$loc->latime}}</td>
	        	  	<td>{{$loc->constructie}}</td>
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