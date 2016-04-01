@extends('layouts.app')
@section('content')
<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
 <h1>Creeaza o noua parcela</h1>

 <ul>
 @foreach($errors->all() as $error)
 <li>{{ $error }}</li>
 @endforeach
 </ul>

 {!! Form::open(array('route' => 'parcele.store', 'class' => 'form')) !!}

 <div class="form-group">
 {!! Form::label('Numar parcela') !!}
 {!! Form::text('numar', null,
 array('required', 'class'=>'form-control',
 'placeholder'=>'NUMAR')) !!}
 </div>

 <div class="form-group">
 {!! Form::label('Cimitir') !!}
 {!! Form::select('cimitir', $cimitire, array ('required', 'class'=>'form-control')) !!}
 </div>

 <div class="form-group">
 {!! Form::submit('Creeaza parcela', array('class'=>'btn btn-primary')) !!}
 </div>
 {!! Form::close() !!}
</div>
 @stop