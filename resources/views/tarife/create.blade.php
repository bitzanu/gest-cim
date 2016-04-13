@extends('layouts.app')

@section('content')
<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
 <h1>Creeaza un nou cimitir</h1>

 <ul>
 @foreach($errors->all() as $error)
 <li>{{ $error }}</li>
 @endforeach
 </ul>

 {!! Form::open(array('route' => 'tarife.store', 'class' => 'form')) !!}

 <div class="form-group">
 {!! Form::label('An') !!}
 {!! Form::text('an', null,
 array('required', 'class'=>'form-control',
 'placeholder'=>'AN')) !!}
 </div>

 <div class="form-group">
 {!! Form::label('Redeventa') !!}
 {!! Form::text('redeventa', null,
 array('required', 'class'=>'form-control',
 'placeholder'=>'REDEVENTA')) !!}
 </div>
 <div class="form-group">
 {!! Form::label('Intretinere') !!}
 {!! Form::text('intretinere', null,
 array('required', 'class'=>'form-control',
 'placeholder'=>'INTRETINERE')) !!}
 </div>

 <div class="form-group">
 {!! Form::submit('Creeaza tarif', array('class'=>'btn btn-primary')) !!}
 </div>
 {!! Form::close() !!}
</div>
 @stop
