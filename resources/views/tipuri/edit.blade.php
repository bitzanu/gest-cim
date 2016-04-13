@extends('layouts.app')

 @section('content')
<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
 <h1>Editeaza tip concesiune</h1>

 <ul>
 @foreach($errors->all() as $error)
 <li>{{ $error }}</li>
 @endforeach
 </ul>

 {!! Form::model($tip, array(
 		'method'=>'put', 
 		'route' => ['tipuri.update' , $tip->id ], 
 		'class' => 'form')) !!}
{!! Form::hidden('id', $tip->id) !!}
 <div class="form-group">
 	{!! Form::label('Nume') !!}
 	{!! Form::text('nume', null, array('required', 'class'=>'form-control')) !!}
 </div>

 <div class="form-group">
 	{!! Form::label('Procent reducere') !!}
 	{!! Form::text('reducere', null, array('required', 'class'=>'form-control')) !!}
 </div>

 <div class="form-group">
 	{!! Form::submit('Modifica tip', array('class'=>'btn btn-primary')) !!}
 </div>
 {!! Form::close() !!}
 <div class="form-group">
 	{!! Form::open( array('route' => array('tipuri.destroy' , $tip->id) , 'method' => 'delete')) !!}
 	{!! Form::submit('Sterge tip', ['class'=>'btn btn-danger btn-mini']) !!}
	{!! Form::close() !!}
 </div>
</div>
 @stop