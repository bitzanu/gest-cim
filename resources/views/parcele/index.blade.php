@extends('layouts.app')
@section('content') 
 
 <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-1 main panel panel-default">
    <div class="panel-heading">
    @include('layouts.partials.alerts')
    <h1 class="page-header">Parcele</h1>
    <table class="table table-condensed">
    {!! Form::open(array('route' => 'parcele_index_filtrat', 'class' => 'form' , 'method' => 'POST' )) !!}
        <tr>
        <td>{!! Form::text('numar', null, array('class'=>'form-control', 'placeholder'=>'NUMAR')) !!}</td>
        <td>{!! Form::select('cimitir', $cimitire, null , ['optional' => 'Alege un cimitir'] , array ('class'=>'form-control')) !!}</td>
        <td>{!! Form::submit('Filtreaza', array('class'=>'btn btn-primary')) !!}</td>
        </tr>
    {!! Form::close() !!}
    </table>
    </div>
        @if( $parcele )
        <table class="table table-condensed table-responsive table-hover">
            <thead>
                <tr><th>Locuri</th><th>NUMAR</th><th>CIMITIR</th></tr>
            </thead>
            <tbody>
                <?php $i=1; ?> 
                  @foreach($parcele as $parcela) 
                	  <tr class="clickable" data-toggle="collapse" id="row{{$i}}" data-target=".row{{$i}}">
                	  	<td><i class="glyphicon glyphicon-plus"></i></td>
                        <td>{{$parcela->numar}}</td>
                	  	<td>{{$parcela->cimitir->nume}}</td>
                	  	<td> <a class="btn btn-small btn-success" href="{{ route ('parcele.edit' , $parcela->id) }}">Edit</a></td>
                	  	<td><a class="btn btn-small btn-success" href="{{ route ('parcele.show' , $parcela->id) }}">Locuri</a></td>
                	  </tr>
                       @foreach($parcela->locuri as $loc)

                        <tr class="collapse row{{$i}}">
                            <td></td>
                            <td>loc nr: {{$loc->numar}}</td>
                            <td>l:{{$loc->lungime}},L:{{$loc->latime}},locuri:{{$loc->numar_locuri}},constr:{{$loc->constructie}}</td>
                            <td> <a class="btn btn-small btn-info" href="{{ route ('locuri.edit' , $loc->id) }}">Edit</a></td>
                            <td><a class="btn btn-small btn-info" href="{{ route ('locuri.show' , $loc->id) }}">Concesiuni</a></td>
                        </tr>


                    @endforeach()

                    <?php $i++ ?>
       			@endforeach
            </tbody>      	
        </table>
 			
        @endif
 
        @if( $parcele->isEmpty() )
           <h3>Nu exista nicio parcela</h3>
        @endif
    {!! $parcele->render() !!} 
    <div>
        <a class="btn btn-info" href="{{ route('parcele.create') }}">Parcela noua</a>
        <a class="btn btn-info" href="{{ route('print_parcele') }}">Listare</a>
        <a class="btn btn-info" href="{{ route('export_parcele') }}">Export</a>
	</div>
 	
</div>
@endsection