@extends('layouts.app')

 @section('content')

 <h1>Sterge cimitir</h1>

 {!! Form::open( array('route' => array('cimitire.destroy' , $cimitir->id) , 
 						'method' => '\delete')) 
 !!}

 {!! Form::submit('Delete', ['class'=>'btn btn-danger btn-mini']) !!}
 {!! Form::close() !!}

 @stop