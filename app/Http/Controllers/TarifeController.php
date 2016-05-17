<?php

namespace gestiune_cimitire\Http\Controllers;

use Illuminate\Http\Request;

use gestiune_cimitire\Http\Requests;
use gestiune_cimitire\Http\Requests\TarifFormRequest;
use gestiune_cimitire\Tarif;
use Session;
use Auth;
use Log;
use View;
use Excel;

class TarifeController extends Controller
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
        $tarife=Tarif::orderBy('an')->paginate(10);
        Session::put('tarife', $tarife);
        return view('tarife.index')->with('tarife' , $tarife);
    }
     public function index_filtrat(Request $request) {
        if ($request->has('an') ) {
        $tarife=Tarif::filtreaza($request->all())->orderBy('an')->paginate(10);
         }   else {
        $tarife=Tarif::orderBy('an')->paginate(10);
         }
        Session::put('tarife', $tarife);
        return view('tarife.index')->with('tarife' , $tarife);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view ('tarife.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TarifFormRequest $request)
    {
        //
        $tarif= new Tarif(array(
                'an' => $request->get('an'),
                'redeventa' => $request->get('redeventa'),
                'intretinere' => $request->get('intretinere'),
            ));
        $tarif->save();
        $user=Auth::user()->name; 
        Log::info('' .$user.' a creeat tariful ' .$tarif->an.''.$tarif->redeventa);
        return \Redirect::route('tarife.index')->with('message','Tariful a fost creeat');
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
         $tarif=Tarif::findOrFail($id);
        return view('tarife.edit')->with('tarif' , $tarif);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TarifFormRequest $request, $id)
    {
        //
        $tarif=Tarif::findOrFail($id);
        $tarif->update([
            'an' => $request->get('an'),
            'redeventa' => $request->get('redeventa'),
            'intretinere' => $request->get('intretinere'),
            ]);
        $user=Auth::user()->name; 
        Log::info('' .$user.' a modificat tariful ' .$tarif->an.' '.$tarif->redeventa);
        return \Redirect::route('tarife.index')->with('message' , 'Tariful a fost modificata');
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
    $tarif=Tarif::findOrFail($id);
    if ($tarif->concesiuni->count()==0){
    Tarif::destroy($id);
    $user=Auth::user()->name; 
    Log::info('' .$user.' a sters tariful ' .$tarif->an.' '.$tarif->redeventa);
    return \Redirect::route('tarife.index')->with('message' , 'Tariful a fost sters');
    } else  {
        return \Redirect::route('tarife.index')->with('message' , 'Exista concesiuni! Tariful nu a fost sters!');
    }
    }

    public function print_tarife (Request $request)
    {
        $tarife=$request->session()->get('tarife');  
        return \PDF::loadView('tarife.print', array('tarife'=>$tarife))->download('tarife.pdf');
    }
    
    public function export_tarife ()
    {
        $tarife=Tarif::all();
        Excel::create('tarife', function($excel) use($tarife) {
            $excel->sheet('Sheet 1', function($sheet) use($tarife) {
            $sheet->fromModel($tarife);
            });
        })->download('xlsx');
    }
}
