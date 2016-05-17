@extends('layouts.app')

 @section('content')
<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
 <h1>Editeaza parcela</h1>

 <ul>
 @foreach($errors->all() as $error)
 <li>{{ $error }}</li>
 @endforeach
 </ul>

 {!! Form::model($parcela, array(
 		'method'=>'put', 
 		'route' => ['parcele.update' , $parcela->id  ], 
 		'class' => 'form')) !!}
{!! Form::hidden('id', $parcela->id) !!}
{!! Form::hidden('cimitir_id', $parcela->cimitir->id) !!}
 <div class="form-group">
 	{!! Form::label('Numar parcela') !!}
 	{!! Form::text('numar', null, array('required', 'class'=>'form-control')) !!}
 </div>

 <div class="form-group">
 	{!! Form::label('Cimitir') !!}
 	{!! Form::select('cimitir', $cimitire, $parcela->cimitir->id, array ('required', 'class'=>'form-control')) !!}
 </div>

 <div class="form-group">
 	{!! Form::submit('Modifica parcela', array('class'=>'btn btn-primary')) !!}
 </div>
 {!! Form::close() !!}
 <div class="form-group">
 	{!! Form::open( array('route' => array('parcele.destroy' , $parcela->id) , 'method' => 'delete')) !!}
 	{!! Form::submit('Sterge parcela', ['class'=>'btn btn-danger btn-mini']) !!}
	{!! Form::close() !!}
 </div>
</div>
 @stop