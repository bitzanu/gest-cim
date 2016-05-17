@extends('layouts.app')
@section('content')
 
 <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-1 main panel panel-default">
    <div class="panel-heading">
    @include('layouts.partials.alerts')
    <h1 class="page-header">Cimitire</h1>
    <table class="table table-condensed">
    {!! Form::open(array('route' => 'index_filtrat', 'class' => 'form' , 'method' => 'POST' )) !!}
        <tr>
        <td>{!! Form::text('nume', null, array('class'=>'form-control', 'placeholder'=>'NUME')) !!}</td>
        <td>{!! Form::submit('Filtreaza', array('class'=>'btn btn-primary')) !!}</td>
        </tr>
    {!! Form::close() !!}
    </table>
    </div>
        @if( $cimitire )
        <table class="table table-condensed">
              	@foreach($cimitire as $cimitir) 
        	  <tr>
        	  	<td>{{$cimitir->nume}}</td>
        	  	<td>{{$cimitir->adresa}}</td>
        	  	<td> <a class="btn btn-small btn-success" href="{{ route ('cimitire.edit' , $cimitir->id) }}">Edit</a></td>
        	  	<td><a class="btn btn-small btn-success" href="{{ route ('cimitire.show' , $cimitir->id) }}">Parcele</a></td>
        	  </tr>
   			@endforeach      	
        </table>
 			
        @endif
 
        @if( $cimitire->isEmpty() )
           <h3>Nu exista niciun cimitir</h3>
        @endif
    {!! $cimitire->render() !!}
    <div>
    <a class="btn btn-info" href="{{ route('cimitire.create') }}">Cimitir nou</a>
    <a class="btn btn-info" href="{{ route('print_cimitire') }}">Listare</a>
    <a class="btn btn-info" href="{{ route('export_cimitire') }}">Export</a>
    </div>
 	
</div>
@endsection