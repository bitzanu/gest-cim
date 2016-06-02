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
        <table class="table table-condensed table-responsive table-hover">
        <thead>
                <tr><th>Concesiuni</th><th>NUME</th><th>PRENUME</th><th>ADRESA</th><th>CNP</th></tr>
        </thead>
        <tbody>
                <?php $i=1; ?> 
              	@foreach($persoane as $persoana) 
                	  <tr class="clickable" data-toggle="collapse" id="row{{$i}}" data-target=".row{{$i}}">
                         @if($persoana->concesiuni->count()>0)
                          <td><i class="glyphicon glyphicon-plus"></i></td>
                          @else <td></td>
                          @endif
                	  	<td>{{$persoana->nume}}</td>
                        <td>{{$persoana->prenume}}</td>
                	  	<td>{{$persoana->adresa}}</td>
                        <td>{{$persoana->CNP}}</td>
                	  	<td> <a class="btn btn-small btn-success" href="{{ route ('persoane.edit' , $persoana->id) }}">Edit</a></td>
                	  	<td><a class="btn btn-small btn-success" href="{{ route ('persoane.show' , $persoana->id) }}">Concesiuni</a></td>
                	  </tr>
                      @foreach($persoana->concesiuni as $concesiune)

                        <tr class="collapse row{{$i}}">
                            <td></td>
                            <td>conc: {{$concesiune->numar}},activa:<?php echo $concesiune->activa ? "DA" :  "NU"  ?>
                            </td>
                            <td>an:{{$concesiune->tarif->an}}</td>
                            <td>
                                tip:{{$concesiune->tip->nume}},durata:{{$concesiune->durata}} ani<br>
                                loc:{{$concesiune->loc->numar}},
                                parcela:{{$concesiune->loc->parcela->numar}},
                                cimitir:{{$concesiune->loc->parcela->cimitir->nume}} 

                            </td>
                            <td>
                              @foreach($concesiune->persoane as $persoana)
                                {{$persoana->nume}},{{$persoana->prenume}}-{{$persoana->CNP}};
                                <br>
                              @endforeach()
                            </td>
                            <td> <a class="btn btn-small btn-info" href="{{ route ('concesiuni.edit' , $concesiune->id) }}">Edit</a></td>
                            <td><a class="btn btn-small btn-info" href="{{ route ('concesiuni.show' , $concesiune->id) }}">Rate</a></td>
                        </tr>


                    @endforeach()

                    <?php $i++ ?>
   			    @endforeach()
            </tbody>      	
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