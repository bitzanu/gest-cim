@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Administrator</div>

                <div class="panel-body">
                <h1>Gestiune Cimitire</h1>
 
        <p>Descriere:</p>
                    Esti logat ca : {{Auth::user()->name}} si admin= {{Auth::user()->admin}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
