@extends('layouts.app')
@section('content')
 
 <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
    @include('layouts.partials.alerts')
    <h1 class="page-header">Tipuri concesiuni</h1>
    <div >

        @if( $tipuri )
        <table class="table table-condensed">
              	@foreach($tipuri as $tip) 
        	  <tr>
        	  	<td>{{$tip->nume}}</td>
        	  	<td>{{$tip->reducere}}</td>
        	  	<td> <a class="btn btn-small btn-success" href="{{ route ('tipuri.edit' , $tip->id) }}">Edit</a></td>
        	  	<td><a class="btn btn-small btn-success" href="{{ route ('tipuri.show' , $tip->id) }}">Concesiuni</a></td>
        	  </tr>
   			@endforeach      	
        </table>
 			
        @endif
 
        @if( $tipuri->isEmpty() )
           <h3>Nu exista niciun tip concesiune</h3>
        @endif
    </div>
    {!! $tipuri->render() !!}
    <div>
    <a class="btn btn-info" href="{{ route('tipuri.create') }}">Tip nou</a>
    <a class="btn btn-info" href="{{ route('print_tipuri') }}">Listare</a>
    <a class="btn btn-info" href="{{ route('export_tipuri') }}">Export</a>
    </div>
 	
</div>
@endsection