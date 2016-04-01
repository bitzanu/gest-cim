@extends('layouts.app')

 @section('content')
<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
 <h1>Editeaza loc</h1>

 <ul>
 @foreach($errors->all() as $error)
 <li>{{ $error }}</li>
 @endforeach
 </ul>

 {!! Form::model($loc, array(
 		'method'=>'put', 
 		'route' => ['locuri.update' , $loc->id  ], 
 		'class' => 'form')) !!}
{!! Form::hidden('loc', $loc->id) !!}
{!! Form::hidden('parcela', $loc->parcela->id) !!}
{!! Form::hidden('cimitir', $loc->parcela->cimitir->id) !!}
 <div class="form-group">
 {!! Form::label('Numar') !!}
 {!! Form::text('numar', null,
 array('required', 'class'=>'form-control',
 'placeholder'=>'NUMAR')) !!}
 </div>
 <div class="form-group">
 {!! Form::label('Lungime') !!}
 {!! Form::text('lungime', null,
 array('required', 'class'=>'form-control',
 'placeholder'=>'LUNGIME')) !!}
 </div>
 <div class="form-group">
 {!! Form::label('Latime') !!}
 {!! Form::text('latime', null,
 array('required', 'class'=>'form-control',
 'placeholder'=>'LATIME')) !!}
 </div>
 <div class="form-group">
 {!! Form::label('Numar de locuri') !!}
 {!! Form::text('numar_locuri', null,
 array('required', 'class'=>'form-control',
 'placeholder'=>'NUMAR LOCURI')) !!}
 </div>
 <div class="form-group">
 {!! Form::label('Constructie') !!}
 {!! Form::text('constructie', null,
 array('class'=>'form-control',
 'placeholder'=>'CONSTRUCTIE')) !!}
 </div>

 <div class="form-group">
    <label>Cimitir
        <select id="cimitir" name="cimitir" class="form-control input-sm">
         <option value="{{$loc->parcela->cimitir->id}}" selected="selected" disabled="disabled">{{$loc->parcela->cimitir->nume}}</option>
             @foreach($cimitire as $cimitir)
           <option value="{{$cimitir->id}}" >{{$cimitir->nume}}</option>
            @endforeach
           </select>
    </label>
</div>
 
<div class="form-group">
    <label>Parcela
        <select id="parcela" name="parcela" class="form-control input-sm" name="parcela">
            <option value="{{$loc->parcela->id}}" selected="selected" disabled="disabled">{{$loc->parcela->numar}}</option>
       </select>
    </label>
</div>

 <div class="form-group">
 	{!! Form::submit('Modifica loc', array('class'=>'btn btn-primary')) !!}
 </div>
 {!! Form::close() !!}
 <div class="form-group">
 	{!! Form::open( array('route' => array('locuri.destroy' , $loc->id) , 'method' => 'delete')) !!}
 	{!! Form::submit('Sterge loc', ['class'=>'btn btn-danger btn-mini']) !!}
	{!! Form::close() !!}
 </div>
</div>
 @stop
 @section('scripts')
{{-- you can add a source here again or directly write the script in script tags--}}
<script type="text/javascript" src="{{ URL::asset('assets/js/script.js') }}"></script>
@stop