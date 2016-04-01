<?php

namespace gestiune_cimitire\Http\Controllers;

use Illuminate\Http\Request;

use gestiune_cimitire\Http\Requests;

class RateController extends Controller
{
    //
    public function __construct()
    {
    $this->middleware('auth');
    }
}
