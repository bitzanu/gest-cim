@extends('layouts.app')

 @section('content')
<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
 <h1>Editeaza cimitir</h1>

 <ul>
 @foreach($errors->all() as $error)
 <li>{{ $error }}</li>
 @endforeach
 </ul>

 {!! Form::model($cimitir, array(
 		'method'=>'put', 
 		'route' => ['cimitire.update' , $cimitir->id ], 
 		'class' => 'form')) !!}
{!! Form::hidden('id', $cimitir->id) !!}
 <div class="form-group">
 	{!! Form::label('Nume cimitir') !!}
 	{!! Form::text('nume', null, array('required', 'class'=>'form-control')) !!}
 </div>

 <div class="form-group">
 	{!! Form::label('Adresa') !!}
 	{!! Form::text('adresa', null, array('required', 'class'=>'form-control')) !!}
 </div>

 <div class="form-group">
 	{!! Form::submit('Modifica cimitir', array('class'=>'btn btn-primary')) !!}
 </div>
 {!! Form::close() !!}
 <div class="form-group">
 	{!! Form::open( array('route' => array('cimitire.destroy' , $cimitir->id) , 'method' => 'delete')) !!}
 	{!! Form::submit('Sterge cimitir', ['class'=>'btn btn-danger btn-mini']) !!}
	{!! Form::close() !!}
 </div>
</div>
 @stop