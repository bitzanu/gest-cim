@extends('layouts.app')

@section('content')
<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
 <h1>Creeaza concesiune</h1>

 <ul>
 @foreach($errors->all() as $error)
 <li>{{ $error }}</li>
 @endforeach
 </ul>

 {!! Form::open(array('route' => 'concesiuni.store', 'class' => 'form')) !!}

 <div class="form-group">
 {!! Form::label('Numar') !!}
 {!! Form::text('numar', null,
 array('required', 'class'=>'form-control',
 'placeholder'=>'NUMAR')) !!}
 </div>
<div class="form-group">
 {!! Form::label('An') !!}
 {!! Form::select('tarif', $tarife , ['class' => 'form-control'] ) !!}
 </div>
 <div class="form-group">
 {!! Form::label('Tip') !!}
 {!! Form::select('tip', $tipuri , ['class' => 'form-control'] ) !!}
 </div>
 <div class="form-group">
 {!! Form::label('persoane','Persoane') !!}
 {!! Form::select('persoane[]', $persoane ,null, ['id'=>'persoane' , 'multiple'=>true ,'required' , 'class' => 'custom-scroll'] ) !!}
 <p id="numepersoane">Nume:</p>
 </div>
 
 <div class="form-group">
 {!! Form::label('Durata') !!}
 {!! Form::text('durata', null,
 array('class'=>'form-control',
 'placeholder'=>'DURATA')) !!}
 </div>
 


<div class="form-group">
{!! Form::label('Loc') !!}
    <table class="table table-condensed">
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
        </tr>
    </table>
 <div class="form-group">
 {!! Form::submit('Creeaza concesiune', array('class'=>'btn btn-primary')) !!}
 </div>
 {!! Form::close() !!}
</div>
@endsection
@section('scripts')
{{-- you can add a source here again or directly write the script in script tags--}}





@stop
