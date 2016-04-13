@extends('layouts.app')

@section('content')
<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
 <h1>Creeaza o noua persoana</h1>

 <ul>
 @foreach($errors->all() as $error)
 <li>{{ $error }}</li>
 @endforeach
 </ul>

 {!! Form::open(array('route' => 'persoane.store', 'class' => 'form')) !!}

 <div class="form-group">
 {!! Form::label('Nume') !!}
 {!! Form::text('nume', null,
 array('required', 'class'=>'form-control',
 'placeholder'=>'NUME')) !!}
 </div>
 <div class="form-group">
 {!! Form::label('Prenume') !!}
 {!! Form::text('prenume', null,
 array('required', 'class'=>'form-control',
 'placeholder'=>'PRENUME')) !!}
 </div>

 <div class="form-group">
 {!! Form::label('Adresa') !!}
 {!! Form::text('adresa', null,
 array('required', 'class'=>'form-control',
 'placeholder'=>'ADRESA')) !!}
 </div>
 <div class="form-group">
 {!! Form::label('CNP') !!}
 {!! Form::text('CNP', null,
 array('required', 'class'=>'form-control',
 'placeholder'=>'CNP')) !!}
 </div>

 <div class="form-group">
 {!! Form::submit('Creeaza persoana', array('class'=>'btn btn-primary')) !!}
 </div>
 {!! Form::close() !!}
</div>
 @stop
