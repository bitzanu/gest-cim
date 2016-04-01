<?php

namespace gestiune_cimitire\Http\Controllers;

use Illuminate\Http\Request;

use gestiune_cimitire\Http\Requests;
use gestiune_cimitire\Cimitir;
use gestiune_cimitire\Parcela;
use gestiune_cimitire\Loc;
use gestiune_cimitire\Http\Requests\LocFormRequest;
use Session;
use Excel;
class LocuriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function __construct(){
         $this->middleware('auth');
    }
    public function index()
    {
        //
        $cimitire=Cimitir::all();
        $locuri=Loc::paginate(10);
        Session::put('locuri',$locuri);
        return view('locuri.index')->with('locuri', $locuri)->with('cimitire', $cimitire);
    }
   

    
     public function index_filtrat(Request $request) 
    {
        $cimitire=Cimitir::all();
        if ($request->has('cimitir')) 
        {  
            if ($request->get('parcela') == '0') {
                  $locuri=Cimitir::findOrFail($request->get('cimitir'))->locuri()
                  ->paginate(10); 
            } else {
                    if ($request->get('loc') == '0') { 
                            $locuri=Parcela::findOrFail($request->get('parcela'))->locuri()
                            ->paginate(10);
                    } else {
                            $locuri=Loc::where('id','=',$request->get('loc'))->paginate(10);
                            }
                    }
        
        } else {

                $locuri=Loc::paginate(10);
                }
                
        Session::put('locuri',$locuri);         
        return view('locuri.index')->with('locuri' , $locuri)->with('cimitire',$cimitire);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
     
      $cimitire=Cimitir::with('parcele')->get();

        return view('locuri.create')->with('cimitire', $cimitire);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(LocFormRequest $request)
    {
        //
        $parcela=Parcela::findOrFail($request->get('parcela'));
        $loc=new Loc(array(
            'numar'=>$request->get('numar'),
            'lungime'=>$request->get('lungime'),
            'latime'=>$request->get('latime'),
            'numar_locuri'=>$request->get('numar_locuri'),
            'constructie'=>$request->get('constructie')
            ));
        $parcela->locuri()->save($loc);
        return \Redirect::route('locuri.index')->with('message', 'Locul a fost creeat' );
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
        $cimitire=Cimitir::with('parcele')->get();
        $loc=Loc::findOrFail($id);
        return view('locuri.edit')->with('loc', $loc)->with('cimitire', $cimitire);
    
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(LocFormRequest $request, $id)
    {
        //
         $loc=Loc::findOrFail($id);
         $parcela=Parcela::findOrFail($request->get('parcela'));
         $loc->update([
            'numar' => $request->get('numar'),
            'lungime' => $request->get('lungime'),
            'latime' => $request->get('latime'),
            'numar_locuri' => $request->get('numar_locuri'),
            'constructie' => $request->get('constructie'),
            ]);
         $parcela->locuri()->save($loc);

        return \Redirect::route('locuri.index')->with('message' , 'Locul a fost modificat');
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
        Loc::destroy($id);
        return \Redirect::route('locuri.index')->with('message' , 'Locul a fost sters');
    }

    public function print_locuri (Request $request)
    {
        $locuri=$request->session()->get('locuri');    
        return \PDF::loadView('locuri.print', array('locuri'=>$locuri))->download('locuri.pdf');
    }
    public function export_locuri ()
    {
        $locuri=Loc::all();
        Excel::create('locuri', function($excel) use($locuri) {
            $excel->sheet('Sheet 1', function($sheet) use($locuri) {
            $sheet->fromModel($locuri);
            });
        })->download('xlsx');
    }
}
