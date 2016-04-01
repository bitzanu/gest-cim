<?php

namespace gestiune_cimitire\Http\Controllers;

use Illuminate\Http\Request;

use gestiune_cimitire\Http\Requests;
use gestiune_cimitire\Http\Controllers\Controller;
use gestiune_cimitire\Http\Requests\ContactFormRequest;

class AboutController extends Controller
{
    //
    public function create(){
    	return view('about.contact');
    }


    public function store(ContactFormRequest $request) {
    	return \Redirect::route('contact')->with('message' , 'Multumim ca ne-ati contactat!');
    }
}
