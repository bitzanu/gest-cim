@extends('layouts.app')
@section('content')
 
 <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-1 main panel panel-default">
    <div class="panel-heading">
    @include('layouts.partials.alerts')
    <h2 class="page-header">Persoane</h2>
    <table class="table table-condensed">
    {!! Form::open(array('route' => 'persoane_index_filtrat', 'class' => 'form' , 'method' => 'POST' )) !!}
        <tr>
        <td>{!! Form::text('nume', null, array('class'=>'form-control', 'placeholder'=>'NUME')) !!}</td>
        <td>{!! Form::text('prenume', null, array('class'=>'form-control', 'placeholder'=>'PRENUME')) !!}</td>
        <td>{!! Form::text('CNP', null, array('class'=>'form-control', 'placeholder'=>'CNP')) !!}</td>
        <td>{!! Form::submit('Filtreaza', array('class'=>'btn btn-primary')) !!}</td>
        </tr>
    {!! Form::close() !!}
    </table>
    </div>

        @if( $persoane )
        <table class="table table-condensed">
              	@foreach($persoane as $persoana) 
        	  <tr>
        	  	<td>{{$persoana->nume}}</td>
                <td>{{$persoana->prenume}}</td>
        	  	<td>{{$persoana->adresa}}</td>
                <td>{{$persoana->CNP}}</td>
        	  	<td> <a class="btn btn-small btn-success" href="{{ route ('persoane.edit' , $persoana->id) }}">Edit</a></td>
        	  	<td><a class="btn btn-small btn-success" href="{{ route ('persoane.show' , $persoana->id) }}">Concesiuni</a></td>
        	  </tr>
   			@endforeach      	
        </table>
 			
        @endif
 
        @if( $persoane->isEmpty() )
           <h3>Nu exista nicio persoana</h3>
        @endif
    {!! $persoane->render() !!}
    <div>
    <a class="btn btn-info" href="{{ route('persoane.create') }}">Persoana noua</a>
    <a class="btn btn-info" href="{{ route('print_persoane') }}">Listare</a>
    <a class="btn btn-info" href="{{ route('export_persoane') }}">Export</a>
    </div>
 	
</div>
@endsection