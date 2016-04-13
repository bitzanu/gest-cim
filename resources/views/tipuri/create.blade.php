@extends('layouts.app')

@section('content')
<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
 <h1>Creeaza un nou tip concesiune</h1>

 <ul>
 @foreach($errors->all() as $error)
 <li>{{ $error }}</li>
 @endforeach
 </ul>

 {!! Form::open(array('route' => 'tipuri.store', 'class' => 'form')) !!}

 <div class="form-group">
 {!! Form::label('Nume tip') !!}
 {!! Form::text('nume', null,
 array('required', 'class'=>'form-control',
 'placeholder'=>'NUME')) !!}
 </div>

 <div class="form-group">
 {!! Form::label('Procent reducere') !!}
 {!! Form::text('reducere', null,
 array('required', 'class'=>'form-control',
 'placeholder'=>'PROCENT REDUCERE')) !!}
 </div>

 <div class="form-group">
 {!! Form::submit('Creeaza tip', array('class'=>'btn btn-primary')) !!}
 </div>
 {!! Form::close() !!}
</div>
 @stop
