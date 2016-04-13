@extends('layouts.app')

 @section('content')
<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
 <h1>Editeaza persoana</h1>

 <ul>
 @foreach($errors->all() as $error)
 <li>{{ $error }}</li>
 @endforeach
 </ul>

 {!! Form::model($persoana, array(
 		'method'=>'put', 
 		'route' => ['persoane.update' , $persoana->id ], 
 		'class' => 'form')) !!}
{!! Form::hidden('id', $persoana->id) !!}
 <div class="form-group">
 	{!! Form::label('Nume') !!}
 	{!! Form::text('nume', null, array('required', 'class'=>'form-control')) !!}
 </div>
 <div class="form-group">
 	{!! Form::label('Prenume') !!}
 	{!! Form::text('prenume', null, array('required', 'class'=>'form-control')) !!}
 </div>

 <div class="form-group">
 	{!! Form::label('Adresa') !!}
 	{!! Form::text('adresa', null, array('required', 'class'=>'form-control')) !!}
 </div>
 <div class="form-group">
 	{!! Form::label('CNP') !!}
 	{!! Form::text('CNP', null, array('required', 'class'=>'form-control')) !!}
 </div>

 <div class="form-group">
 	{!! Form::submit('Modifica persoana', array('class'=>'btn btn-primary')) !!}
 </div>
 {!! Form::close() !!}
 <div class="form-group">
 	{!! Form::open( array('route' => array('persoane.destroy' , $persoana->id) , 'method' => 'delete')) !!}
 	{!! Form::submit('Sterge persoana', ['class'=>'btn btn-danger btn-mini']) !!}
	{!! Form::close() !!}
 </div>
</div>
 @stop