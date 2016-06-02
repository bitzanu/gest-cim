<?php

namespace gestiune_cimitire\Http\Controllers;

use Illuminate\Http\Request;
use gestiune_cimitire\Http\Requests;
use gestiune_cimitire\Persoana;
use gestiune_cimitire\Http\Requests\PersoanaFormRequest;
use View;
use Session;
use Excel;
use Log;
use Auth;

class PersoaneController extends Controller
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
        $persoane=Persoana::paginate(10);
        Session::put('persoane', $persoane);
        return view('persoane.index')->with('persoane' , $persoane);
    }
    public function index_filtrat(Request $request) {
        if ($request->has('nume') or $request->has('prenume') 
            or $request->has('CNP') ) {
        $persoane=Persoana::filtreaza($request->all())->paginate(10);
         }   else {
        $persoane=Persoana::paginate(10);
         }
        Session::put('persoane', $persoane);
        return view('persoane.index')->with('persoane' , $persoane);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function dezasociaza_concesiunea($persoanaid,$concesiuneid){
        $persoana=Persoana::findOrFail($persoanaid);
        $persoana->concesiuni()->detach($concesiuneid);
        $concesiuni=$persoana->concesiuni()->paginate(10);
        return view ('persoane.show')->with('persoana',$persoana)
        ->with('concesiuni',$concesiuni)
        ->with('message','concesiune dezactivata');
    }

    public function create()
    {
        //
        return view ('persoane.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PersoanaFormRequest $request)
    {
        //
         //
        $persoana= new Persoana(array(
                'nume' => $request->get('nume'),
                'prenume' => $request->get('prenume'),
                'adresa' => $request->get('adresa'),
                'CNP' => $request->get('CNP'),
            ));
        $persoana->save();
        $user=Auth::user()->name; 
        Log::info('' .$user.' a creeat persoana ' .$persoana->nume.''.$persoana->prenume);
        return \Redirect::route('persoane.index')->with('message','Persoana a fost creeat');
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
        $persoana=Persoana::findOrFail($id);
        $concesiuni=$persoana->concesiuni()->paginate(10);
        return view('persoane.show')->with(array('persoana'=>$persoana,'concesiuni'=>$concesiuni));
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
        $persoana=Persoana::findOrFail($id);
        return view('persoane.edit')->with('persoana' , $persoana);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PersoanaFormRequest $request, $id)
    {
        //
        $persoana=Persoana::findOrFail($id);
        $persoana->update([
            'nume' => $request->get('nume'),
            'prenume' => $request->get('prenume'),
            'adresa' => $request->get('adresa'),
            'CNP' => $request->get('CNP'),
            ]);
        $user=Auth::user()->name; 
        Log::info('' .$user.' a modificat persoana ' .$persoana->nume.' '.$persoana->prenume);
        return \Redirect::route('persoane.index')->with('message' , 'Persoana a fost modificata');
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
    $persoana=Persoana::findOrFail($id);
    Persoana::destroy($id);
    $user=Auth::user()->name; 
        Log::info('' .$user.' a sters persoana ' .$persoana->nume.' '.$persoana->prenume);
    return \Redirect::route('persoane.index')->with('message' , 'Persoana a fost stearsa');
    }
     public function print_persoane (Request $request)
    {
        $persoane=$request->session()->get('persoane');  
        return \PDF::loadView('persoane.print', array('persoane'=>$persoane))->download('persoane.pdf');
    }
    
    public function export_persoane ()
    {
        $persoane=Persoana::all();
        Excel::create('persoane', function($excel) use($persoane) {
            $excel->sheet('Sheet 1', function($sheet) use($persoane) {
            $sheet->fromModel($persoane);
            });
        })->download('xlsx');
    }

}
