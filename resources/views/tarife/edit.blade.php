@extends('layouts.app')

 @section('content')
<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
 <h1>Editeaza tarif</h1>

 <ul>
 @foreach($errors->all() as $error)
 <li>{{ $error }}</li>
 @endforeach
 </ul>

 {!! Form::model($tarif, array(
 		'method'=>'put', 
 		'route' => ['tarife.update' , $tarif->id ], 
 		'class' => 'form')) !!}
{!! Form::hidden('id', $tarif->id) !!}
 <div class="form-group">
 	{!! Form::label('An') !!}
 	{!! Form::text('an', null, array('required', 'class'=>'form-control')) !!}
 </div>

 <div class="form-group">
 	{!! Form::label('Redeventa') !!}
 	{!! Form::text('redeventa', null, array('required', 'class'=>'form-control')) !!}
 </div>
<div class="form-group">
 	{!! Form::label('Intretinere') !!}
 	{!! Form::text('intretinere', null, array('required', 'class'=>'form-control')) !!}
 </div>
 <div class="form-group">
 	{!! Form::submit('Modifica tarif', array('class'=>'btn btn-primary')) !!}
 </div>
 {!! Form::close() !!}
 <div class="form-group">
 	{!! Form::open( array('route' => array('tarife.destroy' , $tarif->id) , 'method' => 'delete')) !!}
 	{!! Form::submit('Sterge tarif', ['class'=>'btn btn-danger btn-mini']) !!}
	{!! Form::close() !!}
 </div>
</div>
 @stop