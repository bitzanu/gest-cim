@extends('layouts.app')
@section('content')
<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
 <h1>Creeaza un loc nou</h1>

 <ul>
 @foreach($errors->all() as $error)
 <li>{{ $error }}</li>
 @endforeach
 </ul>

 {!! Form::open(array('route' => 'locuri.store', 'class' => 'form')) !!}
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
         <option value="" selected="selected" disabled="disabled">Selecteaza cimitir</option>
             @foreach($cimitire as $cimitir)
           <option value="{{$cimitir->id}}">{{$cimitir->nume}}</option>
            @endforeach
           </select>
    </label>
</div>
 
<div class="form-group">
    <label>Parcela
        <select id="parcela" name="parcela" class="form-control input-sm" >
            <option value="">Selecteza intai cimitirul</option>
       </select>
    </label>
</div>
  		

 <div class="form-group">
 {!! Form::submit('Creeaza loc', array('class'=>'btn btn-primary')) !!}
 </div>
 {!! Form::close() !!}
</div>
 @stop
 @section('scripts')
{{-- you can add a source here again or directly write the script in script tags--}}
<script type="text/javascript" src="{{ URL::asset('assets/js/script.js') }}"></script>
@stop