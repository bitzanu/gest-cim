@extends('layouts.app')

@section('content')

<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">

<h2>Cimitir:{{$loc->parcela->cimitir->nume}}, parcela:{{$loc->parcela->numar}}, nr:{{$loc->numar}}</h2>
<table class="table table-condensed">
	<tr>
		<td> {{$loc->lungime}} </td>
		<td> {{$loc->latime}} </td>
		<td> {{$loc->numar_locuri}} </td>
		<td> {{$loc->constructie}} </td>
	</tr>
<table>
<h3>Concesiuni:</h3>
	@if ($loc->concesiuni->count() > 0)
	
	<table class="table table-condensed">
		
			@foreach ($concesiuni as $concesiune)
				<tr>
				<td> {{$concesiune->numar}} </td>
				<td> {{$concesiune->tarif->an}} </td>
				<td> {{$concesiune->activa}} </td>
				
				<td> <a class="btn btn-small btn-success" href="{{ route ('concesiuni.edit' , $concesiune->id) }}">Edit</a></td>
				<td> <a class="btn btn-small btn-success" href="{{ route ('concesiuni_dezactivare' , $concesiune->id) }}">Dezactiveaza</a></td>
        	  	<td><a class="btn btn-small btn-success" href="{{ route ('concesiuni.show' , $concesiune->id) }}">Rate</a></td>
				</tr>
			@endforeach
		
	</table>

		@else 
		<p>
			Nu exista nicio concesiune!			
		</p>
	@endif
<div>
    <a class="btn btn-info" href="{{ route('concesiuni.create') }}">Concesiune noua</a>
 </div>
</div>
{!! $concesiuni->render() !!}
 
@endsection