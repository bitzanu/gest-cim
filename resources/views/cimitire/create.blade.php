@extends('layouts.app')

@section('content')
<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
 <h1>Creeaza un nou cimitir</h1>

 <ul>
 @foreach($errors->all() as $error)
 <li>{{ $error }}</li>
 @endforeach
 </ul>

 {!! Form::open(array('route' => 'cimitire.store', 'class' => 'form')) !!}

 <div class="form-group">
 {!! Form::label('Nume cimitir') !!}
 {!! Form::text('nume', null,
 array('required', 'class'=>'form-control',
 'placeholder'=>'NUME')) !!}
 </div>

 <div class="form-group">
 {!! Form::label('Adresa') !!}
 {!! Form::text('adresa', null,
 array('required', 'class'=>'form-control',
 'placeholder'=>'ADRESA')) !!}
 </div>

 <div class="form-group">
 {!! Form::submit('Creeaza cimitir', array('class'=>'btn btn-primary')) !!}
 </div>
 {!! Form::close() !!}
</div>
 @stop
