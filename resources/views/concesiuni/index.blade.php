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
        <table class="table table-condensed  table-responsive table-hover">
         <thead>
                <tr><th>Rate</th><th>NR</th><th>AN</th><th>DURATA</th><th>ACTIVA</th><TH>TIP</TH>
                <th>CIMITIR</th><th>PARCELA</th><th>LOC</th><th>DE PLATA</th><th>PERSOANE</th>
                </tr>
        </thead>
        <tbody>
                <?php $i=1; ?> 
              	@foreach($concesiuni as $concesiune) 
        	  <tr class="clickable" data-toggle="collapse" id="row{{$i}}" data-target=".row{{$i}}">
              @if($concesiune->rate->count()>0)
                          <td><i class="glyphicon glyphicon-plus"></i></td>
                          @else <td></td>
                          @endif
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
                <td>{{$concesiune->rest_de_plata}}</td>
                <td>
                      @foreach($concesiune->persoane as $persoana)
                        {{$persoana->nume}},{{$persoana->prenume}}:{{$persoana->CNP}};<br>
                      @endforeach      
                </td>

        	  	  <td> <a class="btn btn-small btn-success" href="{{ route ('concesiuni.edit' , $concesiune->id) }}">Edit</a></td>
        	  	<td><a class="btn btn-small btn-success" href="{{ route ('concesiuni.show' , $concesiune->id) }}">Rate</a></td>
              @if ($concesiune->activa)
              <td> <a class="btn btn-small btn-success" href="{{ route ('concesiuni_dezactivare' , $concesiune->id) }}">Dezactivare</a></td>
              @endif()
        	  </tr>
              @foreach($concesiune->rate as $rata)

                        <tr class="collapse row{{$i}}">
                            <td></td>
                            <td>an: {{$rata->tarif->an}}</td>
                            <td>redev: {{$rata->tarif->redeventa}}</td>
                            <td>intr: {{$rata->tarif->intretinere}}</td>
                            <td>total: {{$rata->tarif->redeventa+$rata->tarif->intretinere}}</td>
                            <td>platit: {{$rata->platit}}</td>
                            <td>de plata: {{$rata->de_plata}}</td>
                            <td>rest: {{$rata->de_plata-$rata->platit}}</td>
                             <td></td>
                              <td></td>
                               <td></td>
                            <td> <a class="btn btn-small btn-info" href="{{ route ('rate.edit' , $concesiune->id) }}">Edit</a></td>
                            <td><a class="btn btn-small btn-info" href="{{ route ('rate.show' , $concesiune->id) }}">Plati</a></td>
                        </tr>


                    @endforeach()

                    <?php $i++ ?>
   			@endforeach()  
        </tbody>
        </table>
 			
        @endif()
 
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