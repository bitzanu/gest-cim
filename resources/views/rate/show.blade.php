@extends('layouts.app')

@section('content')

<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">

<h1>{{$cimitir->nume}}</h1>
<h3>{{$cimitir->adresa}}</h3>
<h2>Parcele:</h2>
	@if ($cimitir->parcele->count() > 0)
	<table class="table table-condensed">
    {!! Form::open(array('route' => 'show_filtrat', 'class' => 'form' , 'method' => 'POST' )) !!}
        <tr>
	        <td>{{ Form::hidden('id', $cimitir->id) }}</td>
    	    <td>{!! Form::text('numar', null, array('class'=>'form-control', 'placeholder'=>'NUMAR')) !!}</td>
        	<td>{!! Form::submit('Filtreaza', array('class'=>'btn btn-primary')) !!}</td>
        </tr>
    {!! Form::close() !!}
    </table>
	<table class="table table-condensed">
		
			@foreach ($parcele as $parcela)
				<tr>
				<td> {{$parcela->numar}} </td>
				<td> <a class="btn btn-small btn-success" href="{{ route ('parcele.edit' , $parcela->id) }}">Edit</a></td>
        	  	<td><a class="btn btn-small btn-success" href="{{ route ('parcele.show' , $parcela->id) }}">Locuri</a></td>
				</tr>
			@endforeach
		
	</table>

		@else 
		<p>
			Nu exista nici o parcela!			
		</p>
	@endif
<div>
    <a class="btn btn-info" href="{{ route('parcele.create') }}">Parcela noua</a>
 </div>
</div>
{!! $parcele->render() !!}
 
@endsection