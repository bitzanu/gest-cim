@extends('layouts.app')
@section('content')
 
 <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
    @include('layouts.partials.alerts')
    <h1 class="page-header">Parcele</h1>
    <div >
    <table class="table table-condensed">
    {!! Form::open(array('route' => 'parcele_index_filtrat', 'class' => 'form' , 'method' => 'POST' )) !!}
        <tr>
        <td>{!! Form::text('numar', null, array('class'=>'form-control', 'placeholder'=>'NUMAR')) !!}</td>
        <td>{!! Form::select('cimitir', $cimitire, null , ['optional' => 'Alege un cimitir'] , array ('class'=>'form-control')) !!}</td>
        <td>{!! Form::submit('Filtreaza', array('class'=>'btn btn-primary')) !!}</td>
        </tr>
    {!! Form::close() !!}
    </table>

        @if( $parcele )
        <table class="table table-condensed">
              	@foreach($parcele as $parcela) 
        	  <tr>
        	  	<td>{{$parcela->numar}}</td>
        	  	<td>{{$parcela->cimitir->nume}}</td>
        	  	<td> <a class="btn btn-small btn-success" href="{{ route ('parcele.edit' , $parcela->id) }}">Edit</a></td>
        	  	<td><a class="btn btn-small btn-success" href="{{ route ('parcele.show' , $parcela->id) }}">Locuri</a></td>
        	  </tr>
   			@endforeach      	
        </table>
 			
        @endif
 
        @if( $parcele->isEmpty() )
           <h3>Nu exista nicio parcela</h3>
        @endif
    </div>
    {!! $parcele->render() !!} 
    <div>
        <a class="btn btn-info" href="{{ route('parcele.create') }}">Parcela noua</a>
        <a class="btn btn-info" href="{{ route('print_parcele') }}">Listare</a>
        <a class="btn btn-info" href="{{ route('export_parcele') }}">Export</a>
	</div>
 	
</div>
@endsection