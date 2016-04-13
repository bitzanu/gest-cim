@extends('layouts.app')
@section('content')
 
 <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
    @include('layouts.partials.alerts')
    <h1 class="page-header">Concesiuni</h1>
    <div >
    <table class="table table-condensed">
    {!! Form::open(array('route' => 'index_filtrat', 'class' => 'form' , 'method' => 'POST' )) !!}
        <tr>
        <td>{!! Form::text('numar', null, array('class'=>'form-control', 'placeholder'=>'NUMAR')) !!}</td>
        <td>{!! Form::text('an', null, array('class'=>'form-control', 'placeholder'=>'AN')) !!}</td>  
        <td>{!! Form::label('active?') !!} {!! Form::checkbox('activa',true,false)!!}</td>

        <td>{!! Form::submit('Filtreaza', array('class'=>'btn btn-primary')) !!}</td>
        </tr>
    {!! Form::close() !!}
    </table>

        @if( $concesiuni )
        <table class="table table-condensed">
              	@foreach($concesiuni as $concesiune) 
        	  <tr>
        	  	<td>{{$concesiune->numar}}</td>
        	  	<td>{{$concesiune->tarif->an}}</td>
                <td>{{$concesiune->durata}}</td>
                @if ($concesiune->activa )
                    <td>DA</td> 
                @else
                    <td>NU</td>
                @endif
        	  	<td> <a class="btn btn-small btn-success" href="{{ route ('concesiuni.edit' , $concesiune->id) }}">Edit</a></td>
        	  	<td><a class="btn btn-small btn-success" href="{{ route ('concesiuni.show' , $concesiune->id) }}">Rate</a></td>
        	  </tr>
   			@endforeach      	
        </table>
 			
        @endif
 
        @if( $concesiuni->isEmpty() )
           <h3>Nu exista nicio concesiune</h3>
        @endif
    </div>
    {!! $concesiuni->render() !!}
    <div>
    <a class="btn btn-info" href="{{ route('concesiuni.create') }}">Concesiune noua</a>
    <a class="btn btn-info" href="{{ route('print_concesiuni') }}">Listare</a>
    <a class="btn btn-info" href="{{ route('export_concesiuni') }}">Export</a>
    </div>
 	
</div>
@endsection