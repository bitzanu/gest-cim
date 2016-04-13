@extends('layouts.print')
@section('header')
<div id="header">
	<h1 align="center">Lista Cimitire</h1>
</div>

@endsection
@section('content')
<div id="tarife">
	<table>
		<tr>
	    	<th>An</th>
	    	<th>Redeventa</th>
	    	<th>Intretinere</th>
	    	<th>Nr concesiuni</th>
	  	</tr>
	  	@foreach($tarife as $tarif) 
	        	  <tr>
	        	  	<td>{{$tarif->an}}</td>
	        	  	<td>{{$tarif->redeventa}}</td>
	        	  	<td>{{$tarif->intretinere}}</td>
	        	  	<td>{{$tarif->concesiuni->count()}}</td>
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