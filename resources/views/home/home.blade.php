@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                <h1>Gestiune Cimitire</h1>
@if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
@endif
 
        <p>Descriere:</p>
 
        <p><img src="{{ asset('images/siglaurbiscentrat.jpg') }}" /></p>
                    Esti logat ca : {{Auth::user()->name}} si admin= {{Auth::user()->admin}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
