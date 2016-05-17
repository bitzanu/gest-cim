<?php

namespace gestiune_cimitire\Http\Controllers;

use Illuminate\Http\Request;

use gestiune_cimitire\Http\Requests;
use gestiune_cimitire\Rata;
use gestiune_cimitire\Cimitir;
use View;
use Session;
use Excel;
use Log;
use Auth;

class RateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response

     */

    public function __construct()
    {
    $this->middleware('auth');
    }
    public function index()
    {
        //
        $rate=Rata::paginate(10);
        Session::put('rate', $rate);
        return view('rate.index')->with('rate' , $rate);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index_filtrat(Request $request) {
        if ($request->has('nume') ) {
        $cimitire=Cimitir::filtreaza($request->all())->paginate(10);
         }   else {
        $cimitire=Cimitir::paginate(10);
         }
        Session::put('cimitire', $cimitire);
        return view('cimitire.index')->with('cimitire' , $cimitire);
    }
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function print_rate (Request $request)
    {
        $cimitire=$request->session()->get('cimitire');  
        return \PDF::loadView('cimitire.print', array('cimitire'=>$cimitire))->download('cimitire.pdf');
    }
    
    public function export_rate ()
    {
        $cimitire=Cimitir::all();
        Excel::create('cimitire', function($excel) use($cimitire) {
            $excel->sheet('Sheet 1', function($sheet) use($cimitire) {
            $sheet->fromModel($cimitire);
            });
        })->download('xlsx');
    }
}
