@extends('layouts.app')
@section('content') 
 
 <div class="col-sm-9 col-sm-offset-2 col-md-10 col-md-offset-1 main panel panel-default">
    <div class="panel-heading">
        @include('layouts.partials.alerts')
        <h2 class="page-header">Cimitire</h2>
        <table class="table table-condensed table-sm">
            {!! Form::open(array('route' => 'index_filtrat', 'class' => 'form' , 'method' => 'POST' )) !!}
                <tr>
                <td>{!! Form::text('nume', null, array('class'=>'form-control', 'placeholder'=>'NUME')) !!}</td>
                <td>{!! Form::submit('Filtreaza', array('class'=>'btn btn-primary')) !!}</td>
                </tr>
            {!! Form::close() !!}    
        </table>
    </div>  
        @if( $cimitire )
        <table class="table table-condensed table-responsive table-hover">
            <thead>
                <tr><th>Parcele</th><th>NUME</th><th>ADRESA</th></tr>
            </thead>
            <tbody>
            <?php $i=1; ?> 
              	@foreach($cimitire as $cimitir)
            	  <tr class="clickable" data-toggle="collapse" id="row{{$i}}" data-target=".row{{$i}}">
                        <td><i class="glyphicon glyphicon-plus"></i></td>
                	  	<td>{{$cimitir->nume}}</td>
                	  	<td>{{$cimitir->adresa}}</td>
                	  	<td> <a class="btn btn-small btn-success" href="{{ route ('cimitire.edit' , $cimitir->id) }}">Edit</a></td>
                	  	<td><a class="btn btn-small btn-success" href="{{ route ('cimitire.show' , $cimitir->id) }}">Parcele</a></td>
            	  </tr>
                  
                    @foreach($cimitir->parcele as $parcela)

                        <tr class="collapse row{{$i}}">
                            <td></td>
                            <td>Parcela nr: {{$parcela->numar}}</td>
                            <td></td>
                            <td> <a class="btn btn-small btn-info" href="{{ route ('parcele.edit' , $parcela->id) }}">Edit</a></td>
                            <td><a class="btn btn-small btn-info" href="{{ route ('parcele.show' , $parcela->id) }}">Concesiuni</a></td>
                        </tr>


                    @endforeach()

                    <?php $i++ ?>
            
   			   @endforeach()      
            </tbody>  	
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