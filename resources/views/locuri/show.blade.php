@extends('layouts.app')

@section('content')

<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">

<h1>{{$parcela->numar}}</h1>
<h2>Locuri:</h2>
	@if ($parcela->locuri->count() > 0)
	<table class="table table-condensed">
    {!! Form::open(array('route' => 'parcela_show_filtrat', 'class' => 'form' , 'method' => 'POST' )) !!}
        <tr>
	        <td>{{ Form::hidden('id', $loc->id) }}</td>
    	    <td>{!! Form::text('numar', null, array('class'=>'form-control', 'placeholder'=>'NUMAR')) !!}</td>
        	<td>{!! Form::submit('Filtreaza', array('class'=>'btn btn-primary')) !!}</td>
        </tr>
    {!! Form::close() !!}
    </table>
	<table class="table table-condensed">
		
			@foreach ($locuri as $loc)
				<tr>
				<td> {{$loc->numar}} </td>
				<td> {{$loc->lungime}} </td>
				<td> {{$loc->latime}} </td>
				<td> {{$loc->numar_locuri}} </td>
				<td> {{$loc->constructie}} </td>

				<td> <a class="btn btn-small btn-success" href="{{ route ('locuri.edit' , $loc->id) }}">Edit</a></td>
        	  	<td><a class="btn btn-small btn-success" href="{{ route ('locuri.show' , $parcela->id) }}">Detalii</a></td>
				</tr>
			@endforeach
		
	</table>

		@else 
		<p>
			Nu exista niciun loc!			
		</p>
	@endif
<div>
    <a class="btn btn-info" href="{{ route('locuri.create') }}">Loc nou</a>
 </div>
</div>
{!! $parcele->render() !!}
 
@endsection