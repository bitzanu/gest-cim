@extends('layouts.app')

 @section('content')
<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
 <h1>Editeaza concesiune</h1>

 <ul>
 @foreach($errors->all() as $error)
 <li>{{ $error }}</li>
 @endforeach
 </ul>

 {!! Form::model($concesiune, array(
 		'method'=>'put', 
 		'route' => ['concesiuni.update' , $concesiune->id ], 
 		'class' => 'form')) !!}
{!! Form::hidden('id', $concesiune->id) !!}
{!! Form::hidden('tarif', $concesiune->tarif->an) !!}
{!! Form::hidden('loc', $concesiune->loc->id) !!}
 <div class="form-group">
 	{!! Form::label('Numar concesiune') !!}
 	{!! Form::text('numar', null, array('required', 'class'=>'form-control')) !!}
 </div>
<div class="form-group">
 {!! Form::label('Tip') !!}
 {!! Form::select('tip', $tipuri , $concesiune->tip->id, ['class' => 'form-control'] ) !!}
 </div>
 <div class="form-group">
 	{!! Form::label('Durata') !!}
 	{!! Form::text('durata', null, array('required', 'class'=>'form-control')) !!}
 </div>
<div class="form-group">
 {!! Form::label('persoane','Persoane') !!}
 {!! Form::select('persoane[]', $persoane ,$concesiune->persoane->lists('id')->all(), ['id'=>'persoane' , 'multiple'=>true ,'required' , 'class' => 'custom-scroll'] ) !!}
  <p id="numepersoane"></p>
 </div>
<div class="form-group">
{!! Form::label('Loc') !!}
    <table class="table table-condensed">
        <tr>
        <td><select id="cimitir" name="cimitir" class="form-control input-sm">
         <option value="{{$concesiune->loc->parcela->cimitir->id}}" selected="selected" disabled="disabled">{{$concesiune->loc->parcela->cimitir->nume}}</option>
             @foreach($cimitire as $cimitir)
           <option value="{{$cimitir->id}}">{{$cimitir->nume}}</option>
            @endforeach
           </select></td>
        <td><select id="parcela" name="parcela" class="form-control input-sm" >
            <option value="{{$concesiune->loc->parcela->id}}"selected="selected" disabled="disabled">{{$concesiune->loc->parcela->numar}}</option>
       </select></td>
         <td><select id="loc" name="loc" class="form-control input-sm" >
            <option value="{{$concesiune->loc->id}}" selected="selected" disabled="disabled">{{$concesiune->loc->numar}}</option>
       </select></td>
        </tr>
    </table>
 <div class="form-group">
 <div class="form-group">
 	{!! Form::submit('Modifica concesiune', array('class'=>'btn btn-primary')) !!}
 </div>
 {!! Form::close() !!}
 <div class="form-group">
 	{!! Form::open( array('route' => array('concesiuni.destroy' , $concesiune->id) , 'method' => 'delete')) !!}
 	{!! Form::submit('Sterge concesiune', ['class'=>'btn btn-danger btn-mini']) !!}
	{!! Form::close() !!}
 </div>
</div>
 @stop