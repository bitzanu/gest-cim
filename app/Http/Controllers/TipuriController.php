<?php

namespace gestiune_cimitire\Http\Controllers;

use Illuminate\Http\Request;

use gestiune_cimitire\Http\Requests;
use gestiune_cimitire\Http\Requests\TipFormRequest;
use gestiune_cimitire\Tip;
use Auth;
use Log;
use Excel;


class TipuriController extends Controller
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
    $tipuri=Tip::paginate(10);
    return view('tipuri.index')->with('tipuri' , $tipuri);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
     return view ('tipuri.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TipFormRequest $request)
    {
        //
         $tip= new Tip(array(
                'nume' => $request->get('nume'),
                'reducere' => $request->get('reducere')
            ));
        $tip->save();
         $user=Auth::user()->name; 
        Log::info('' .$user.' a creeat tipul ' .$tip->nume);
        return \Redirect::route('tipuri.index')->with('message','tipul a fost creeat');
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
        $tip=Tip::findOrFail($id);
        return view('tipuri.edit')->with('tip',$tip);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TipFormRequest $request, $id)
    {
        //
         $tip=Tip::findOrFail($id);
        $tip->update([
            'nume' => $request->get('nume'),
            'reducere' => $request->get('reducere')
            ]);
        $user=Auth::user()->name; 
        Log::info('' .$user.' a modificat tipul ' .$tip->nume);
        return \Redirect::route('tipuri.index')->with('message' , 'tipul a fost modificat');
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
        $tip=Tip::findOrFail($id);
        $user=Auth::user()->name; 
        if ( $tip->concesiuni->count()==0){
            Log::info('' .$user.' a sters tipul ' .$tip->nume);
            Tip::destroy($id);
            return \Redirect::route('tipuri.index')->with('message' , 'tipul a fost sters');
        } else {
             return \Redirect::route('tipuri.index')->with('message' , 'Exista concesiuni! Tipul nu a fost sters!');
        }
    }
     public function print_tipuri (Request $request)
    {
        $tipuri=Tip::all(); 
        return \PDF::loadView('tipuri.print', array('tipuri'=>$tipuri))->download('ctipuri.pdf');
    }
    
    public function export_tipuri ()
    {
        $tipuri=Tip::all();
        Excel::create('tipuri', function($excel) use($tipuri) {
            $excel->sheet('Sheet 1', function($sheet) use($tipuri) {
            $sheet->fromModel($tipuri);
            });
        })->download('xlsx');
    }
}
