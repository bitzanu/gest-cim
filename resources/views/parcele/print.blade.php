@extends('layouts.print')
@section('header')
<div id="header">
	<h1 align="center">Lista Parcele</h1>
</div>

@endsection
@section('content')
<div id="parcele">
	<table>
		<tr>
	    	<th>Cimitir</th>
	    	<th>Numar</th>
	    	<th>Nr locuri</th>
	    	<th>data creare</th>
	  	</tr>
	  	@foreach($parcele as $parcela) 
	        	  <tr>
	        	  	<td>{{$parcela->cimitir->nume}}</td>
	        	  	<td>{{$parcela->numar}}</td>
	        	  	<td>{{$parcela->locuri->count()}}</td>
	        	  	<td>{{$parcela->created_at}}</td>
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