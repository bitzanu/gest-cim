@extends('layouts.app')
@section('content')
 
 <div class="col-sm-9 col-sm-offset-2 col-md-10 col-md-offset-1 main panel panel-default">
    <div class="panel-heading">
        @include('layouts.partials.alerts')
        <h2 class="page-header">Rate</h2>
        <table class="table table-condensed">
            {!! Form::open(array('route' => 'index_filtrat', 'class' => 'form' , 'method' => 'POST' )) !!}
                <tr>
                <td>{!! Form::text('numar_concesiune', null, array('class'=>'form-control', 'placeholder'=>'NUMAR CONCESIUNE')) !!}</td>
                <td>{!! Form::submit('Filtreaza', array('class'=>'btn btn-primary')) !!}</td>
                </tr>
            {!! Form::close() !!}    
        </table>
    </div>  
        @if( $rate )
        <table class="table table-condensed">
              	@foreach($rate as $rata) 
        	  <tr>
        	  	<td>{{$rata->concesiune->numar}}</td>
        	  	<td>{{$rata->tarif->an}}</td>
                <td>{{$rata->tarif->redeventa+$rata->tarif->intretinere}}</td>
                <td>{{$rata->platit}}</td>
        	  	<td> <a class="btn btn-small btn-success" href="{{ route ('rate.edit' , $rata->id) }}">Edit</a></td>
        	  	<td><a class="btn btn-small btn-success" href="{{ route ('rate.show' , $rata->id) }}">Vizualizare</a></td>
        	  </tr>
   			@endforeach      	
        </table>
 			
        @endif
 
        @if( $rate->isEmpty() )
           <h3>Nu exista nicio rata</h3>
        @endif
    {!! $rate->render() !!}

    <div>
        <a class="btn btn-info" href="{{ route('rate.create') }}">Rata noua</a>
        <a class="btn btn-info" href="{{ route('print_rate') }}">Listare</a>
        <a class="btn btn-info" href="{{ route('export_rate') }}">Export</a>
    </div>
 	
</div>
@endsection