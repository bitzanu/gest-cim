@extends('layouts.app')
@section('content')
  
 <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-1 main panel panel-default">
    <div class="panel-heading">
    @include('layouts.partials.alerts')
    <h2 class="page-header">Locuri</h2>
    <table class="table table-condensed">
    {!! Form::open(array('route' => 'locuri_index_filtrat', 'class' => 'form' , 'method' => 'POST' )) !!}
        <tr>
        <td><select id="cimitir" name="cimitir" class="form-control input-sm">
         <option value="" selected="selected" disabled="disabled">Selecteaza cimitir</option>
             @foreach($cimitire as $cimitir)
           <option value="{{$cimitir->id}}">{{$cimitir->nume}}</option>
            @endforeach
           </select></td>
        <td><select id="parcela" name="parcela" class="form-control input-sm" >
            <option value=""selected="selected" disabled="disabled">Selecteza intai cimitirul</option>
       </select></td>
         <td><select id="loc" name="loc" class="form-control input-sm" >
            <option value="" selected="selected" disabled="disabled">Selecteaza intai parcela</option>
       </select></td>
        <td>{!! Form::submit('Filtreaza', array('class'=>'btn btn-primary')) !!}</td>
        </tr>
    {!! Form::close() !!}
    </table>
    </div>
    

        @if( $locuri )
        <table class="table table-condensed table-responsive table-hover">
            <thead>
                <tr><th>Concesiuni</th><th>NUMAR</th><th>PARCELA</th><th>CIMITIR</th><th>Detalii</th></tr>
            </thead>
            <tbody>
                <?php $i=1; ?> 
              	@foreach($locuri as $loc) 
                	  <tr class="clickable" data-toggle="collapse" id="row{{$i}}" data-target=".row{{$i}}">
                          @if($loc->concesiuni->count()>0)
                          <td><i class="glyphicon glyphicon-plus"></i></td>
                          @else <td></td>
                          @endif
                    	   	<td>{{$loc->numar}}</td>
                    	  	<td>{{$loc->parcela->numar}}</td>
                          <td>{{$loc->parcela->cimitir->nume}}</td>
                          <td>l:{{$loc->lungime}},L:{{$loc->latime}},locuri:{{$loc->numar_locuri}},constr:{{$loc->constructie}},nr conc:{{$loc->concesiuni->count()}}</td>
                    	  	<td> <a class="btn btn-small btn-success" href="{{ route ('locuri.edit' , $loc->id) }}">Edit</a></td>
                    	  	<td><a class="btn btn-small btn-success" href="{{ route ('locuri.show' , $loc->id) }}">Detalii</a></td>
                	  </tr>
                     @foreach($loc->concesiuni as $concesiune)

                        <tr class="collapse row{{$i}}">
                            <td></td>
                            <td>conc: {{$concesiune->numar}}</td>
                            <td>an:{{$concesiune->tarif->an}}</td>
                            <td>tip:{{$concesiune->tip->nume}},durata:{{$concesiune->durata}} ani</td>
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
 
        @if( $locuri->isEmpty() )
           <h3>Nu exista nici un loc</h3>
        @endif
    {!! $locuri->render() !!} 
    <div>
    <a class="btn btn-info" href="{{ route('locuri.create') }}">Loc nou</a>
    <a class="btn btn-info" href="{{ route('print_locuri') }}">Listare</a>
    <a class="btn btn-info" href="{{ route('export_locuri') }}">Export</a>
	</div>
 	
</div>
@endsection
@section('scripts')
{{-- you can add a source here again or directly write the script in script tags--}}
@stop