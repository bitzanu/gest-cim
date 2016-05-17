@extends('layouts.app')

 @section('content')
<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
 <h1>Dezactiveaza concesiunea</h1>

 <ul>
 @foreach($errors->all() as $error)
 <li>{{ $error }}</li>
 @endforeach
 </ul>

 {!! Form::model($concesiune, array(
 		'method'=>'put', 
 		'route' => ['concesiuni_update_dezactivare' , $concesiune->id ], 
 		'class' => 'form')) !!}
{!! Form::hidden('id', $concesiune->id) !!}
 <div class="form-group">
 	{!! Form::label('An sfarsit') !!}
 	{!! Form::select('an', $ani, null  , array ('class'=>'form-control')) !!}
 </div>

 <div class="form-group">
 	{!! Form::label('Motiv sfarsit') !!}
 	{!! Form::text('motiv', null, array('class'=>'form-control')) !!}
 </div>

 <div class="form-group">
 	{!! Form::submit('Dezactiveaza', array('class'=>'btn btn-primary')) !!}
 </div>
 {!! Form::close() !!}
</div>
 @stop