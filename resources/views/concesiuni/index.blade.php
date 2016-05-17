@extends('layouts.app')
@section('content')
 
 <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-1 main panel panel-default">
  <div class="panel-heading">
    @include('layouts.partials.alerts')
    <h2 class="page-header">Concesiuni</h2>
    <table class="table table-condensed">
     {!! Form::open(array('route' => 'concesiuni_index_filtrat', 'class' => 'form' , 'method' => 'POST' )) !!}
        <tr>
        <td>{!! Form::text('numar', null, array('class'=>'form-control', 'placeholder'=>'NUMAR')) !!}</td>
        <td>{!! Form::text('an', null, array('class'=>'form-control', 'placeholder'=>'AN')) !!}</td>
        <td>{!! Form::select('tip', $tipuri, null , ['optional' => 'Alege un tip'] , array ('class'=>'form-control')) !!}</td>  
        <td>{!! Form::label('active?') !!} {!! Form::checkbox('activa',true,false)!!}</td>
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
                <td>{{$concesiune->tip->nume}}</td>
                <td>{{$concesiune->loc->parcela->cimitir->nume}}</td>
                 <td>{{$concesiune->loc->parcela->numar}}</td>
                  <td>{{$concesiune->loc->numar}}</td>
                  <td><table class="table table-condensed">
                      @foreach($concesiune->persoane as $persoana)
                      <tr>
                        <td>{{$persoana->nume}}</td>
                        <td>{{$persoana->prenume}}</td>
                         <td>{{$persoana->CNP}}</td>
                      </tr>
                      @endforeach      
                  </table></td>
        	  	<td> <a class="btn btn-small btn-success" href="{{ route ('concesiuni.edit' , $concesiune->id) }}">Edit</a></td>
        	  	<td><a class="btn btn-small btn-success" href="{{ route ('concesiuni.show' , $concesiune->id) }}">Rate</a></td>
              @if ($concesiune->activa)
              <td> <a class="btn btn-small btn-success" href="{{ route ('concesiuni_dezactivare' , $concesiune->id) }}">Dezactivare</a></td>
              @endif
        	  </tr>
   			@endforeach      	
        </table>
 			
        @endif
 
        @if( $concesiuni->isEmpty() )
           <h3>Nu exista nicio concesiune</h3>
        @endif
    {!! $concesiuni->render() !!}
    <div>
    <a class="btn btn-info" href="{{ route('concesiuni.create') }}">Concesiune noua</a>
    <a class="btn btn-info" href="{{ route('print_concesiuni') }}">Listare</a>
    <a class="btn btn-info" href="{{ route('export_concesiuni') }}">Export</a>
    </div>
 	
</div>
@endsection
@section('scripts')
{{-- you can add a source here again or directly write the script in script tags--}}
@stop