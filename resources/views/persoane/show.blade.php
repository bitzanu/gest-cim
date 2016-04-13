@extends('layouts.app')

@section('content')

<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">

<h1>{{$persoana->nume}}</h1>
<h1>{{$persoana->prenume}}</h1>
<h3>{{$persoana->adresa}}</h3>
<h3>{{$persoana->CNP}}</h3>
<h2>Concesiuni:</h2>
	@if ($concesiuni->count() > 0)
	<table class="table table-condensed">
		
			@foreach ($concesiuni as $concesiune)
				<tr>
				<td> {{$concesiune->numar}} </td>
				<td> <a class="btn btn-small btn-success" href="{{ route ('concesiuni.edit' , $concesiune->id) }}">Edit</a></td>
        	  	<td><a class="btn btn-small btn-success" href="{{ route ('concesiuni.show' , $concesiune->id) }}">Rate</a></td>
				</tr>
			@endforeach
		
	</table>

		@else 
		<p>
			Nu exista nici o concesiune!			
		</p>
	@endif
<div>
    <a class="btn btn-info" href="{{ route('concesiuni.create') }}">Concesiune noua</a>
 </div>
</div>
{!! $concesiuni->render() !!}
 
@endsection