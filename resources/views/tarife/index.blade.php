@extends('layouts.app')
@section('content')
 
 <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-1 main panel panel-default">
    <div class="panel-heading">
    @include('layouts.partials.alerts')
    <h2 class="page-header">Tarife</h2>
    <table class="table table-condensed">
    {!! Form::open(array('route' => 'tarife_index_filtrat', 'class' => 'form' , 'method' => 'POST' )) !!}
        <tr>
        <td>{!! Form::text('an', null, array('class'=>'form-control', 'placeholder'=>'AN')) !!}</td>
        <td>{!! Form::submit('Filtreaza', array('class'=>'btn btn-primary')) !!}</td>
        </tr>
    {!! Form::close() !!}
    </table>
    </div>
        @if( $tarife )
        <table class="table table-condensed">
              	@foreach($tarife as $tarif) 
        	  <tr>
        	  	<td>{{$tarif->an}}</td>
        	  	<td>{{$tarif->redeventa}}</td>
                <td>{{$tarif->intretinere}}</td>
        	  	<td> <a class="btn btn-small btn-success" href="{{ route ('tarife.edit' , $tarif->id) }}">Edit</a></td>
        	  	<td><a class="btn btn-small btn-success" href="{{ route ('tarife.show' , $tarif->id) }}">Concesiuni</a></td>
        	  </tr>
   			@endforeach      	
        </table>
 			
        @endif
 
        @if( $tarife->isEmpty() )
           <h3>Nu exista niciun tarif</h3>
        @endif
    {!! $tarife->render() !!}
    <div>
    <a class="btn btn-info" href="{{ route('tarife.create') }}">Tarif nou</a>
    <a class="btn btn-info" href="{{ route('print_tarife') }}">Listare</a>
    <a class="btn btn-info" href="{{ route('export_tarife') }}">Export</a>
    </div>
 	
</div>
@endsection