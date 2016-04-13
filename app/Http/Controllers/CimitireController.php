<?php

namespace gestiune_cimitire\Http\Controllers;

use Illuminate\Http\Request;
use gestiune_cimitire\Http\Requests;
use gestiune_cimitire\Http\Controllers\Controller;
use gestiune_cimitire\Cimitir;
use gestiune_cimitire\Http\Requests\CimitirFormRequest;
use View;
use Session;
use Excel;
use Log;
use Auth;

class CimitireController extends Controller

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
        $cimitire=Cimitir::paginate(10);
        Session::put('cimitire', $cimitire);
        return view('cimitire.index')->with('cimitire' , $cimitire);

    }

    public function index_filtrat(Request $request) {
        if ($request->has('nume') ) {
        $cimitire=Cimitir::filtreaza($request->all())->paginate(10);
         }   else {
        $cimitire=Cimitir::paginate(10);
         }
        Session::put('cimitire', $cimitire);
        return view('cimitire.index')->with('cimitire' , $cimitire);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view ('cimitire.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CimitirFormRequest $request)
    {
        //
        $cimitir= new Cimitir(array(
        		'nume' => $request->get('nume'),
        		'adresa' => $request->get('adresa')
        	));
        $cimitir->save();
         $user=Auth::user()->name; 
        Log::info('' .$user.' a creeat cimitirul ' .$cimitir->nume);
        return \Redirect::route('cimitire.index')->with('message','Cimitirul a fost creeat');
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
        $cimitir=Cimitir::findOrFail($id);
        $parcele=$cimitir->parcele()->paginate(10);
        return view('cimitire.show')->with(array('cimitir'=>$cimitir,'parcele'=>$parcele));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

   public function show_filtrat(Request $request){
    $cimitir=Cimitir::findOrFail($request->get('id'));
    if ($request){
      $parcele=$cimitir->parcele()->filtreaza($request->all())->paginate(10);
    } else {
      $parcele=$cimitir->parcele()->paginate(10);
    }
    return view('cimitire.show')->with(array('cimitir'=>$cimitir,'parcele'=>$parcele));
   }


    public function edit($id)
    {
        //
        $cimitir=Cimitir::findOrFail($id);
        return view('cimitire.edit')->with('cimitir' , $cimitir);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CimitirFormRequest $request, $id)
    {
        //
        $cimitir=Cimitir::findOrFail($id);
        $cimitir->update([
        	'nume' => $request->get('nume'),
        	'adresa' => $request->get('adresa')
        	]);
        return \Redirect::route('cimitire.index')->with('message' , 'cimitirul a fost modificat');
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
        Cimitir::destroy($id);
        return \Redirect::route('cimitire.index')->with('message' , 'Cimitirul a fost sters');
    }

    public function print_cimitire (Request $request)
    {
        $cimitire=$request->session()->get('cimitire');  
        return \PDF::loadView('cimitire.print', array('cimitire'=>$cimitire))->download('cimitire.pdf');
    }
    
    public function export_cimitire ()
    {
        $cimitire=Cimitir::all();
        Excel::create('cimitire', function($excel) use($cimitire) {
            $excel->sheet('Sheet 1', function($sheet) use($cimitire) {
            $sheet->fromModel($cimitire);
            });
        })->download('xlsx');
    }

}
