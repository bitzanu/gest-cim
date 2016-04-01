<?php

namespace gestiune_cimitire\Http\Controllers;

use Illuminate\Http\Request;
use gestiune_cimitire\Http\Requests;
use Auth;
use gestiune_cimitire\Parcela;
use gestiune_cimitire\Cimitir;
use gestiune_cimitire\Http\Requests\ParcelaFormRequest;
use Session;
use Excel;

class ParceleController extends Controller
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
        $cimitire=[''=>'-Alege Cimitir-']+Cimitir::lists('nume', 'id')->all();
        $parcele=Parcela::paginate(10);
        Session::put('parcele',$parcele);
        return view('parcele.index')->with('parcele', $parcele)->with('cimitire', $cimitire);
    }
    public function index_filtrat(Request $request) {
        $cimitire=[''=>'-Alege Cimitir-']+Cimitir::lists('nume', 'id')->all();
        if ($request->has('numar') or $request->has('cimitir')) {
        $parcele=Parcela::filtreaza($request->all())->paginate(10);
         }   else {
        $parcele=Parcela::paginate(10);
         }
         Session::put('parcele',$parcele);
        return view('parcele.index')->with('parcele' , $parcele)->with('cimitire', $cimitire);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $cimitire=Cimitir::lists('nume', 'id');
        return view('parcele.create')->with('cimitire', $cimitire);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ParcelaFormRequest $request)
    {
        //
        $cimitir=Cimitir::findOrFail($request->get('cimitir'));
        $parcela=new Parcela(array(
            'numar'=>$request->get('numar')
            ));
        $cimitir->parcele()->save($parcela);
        return \Redirect::route('parcele.index')->with('message', 'Parcela a fost creeata' );
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
        $parcela=Parcela::findOrFail($id);
        $locuri=$parcela->locuri()->paginate(10);
        return view('parcele.show')->with(array('parcela'=>$parcela,'locuri'=>$locuri));
    }
    public function show_filtrat(Request $request){
    $parcela=parcela::findOrFail($request->get('id'));
    if ($request){
      $locuri=$parcela->locuri()->filtreaza($request->all())->paginate(10);
    } else {
      $locuri=$parcele->locuri()->paginate(10);
    }
    return view('parcele.show')->with(array('parcela'=>$parcela,'locuri'=>$locuri));
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
        $cimitire=Cimitir::lists('nume', 'id');
        $parcela=Parcela::findOrFail($id);
        return view('parcele.edit')->with('parcela', $parcela)->with('cimitire', $cimitire);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ParcelaFormRequest $request, $id)
    {
        //
         $parcela=Parcela::findOrFail($id);
         $cimitir=Cimitir::findOrFail($request->get('cimitir'));
         $parcela->update([
            'numar' => $request->get('numar')
            ]);
         $cimitir->parcele()->save($parcela);

        return \Redirect::route('parcele.index')->with('message' , 'parcela a fost modificata');
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
        Parcela::destroy($id);
        return \Redirect::route('parcele.index')->with('message' , 'Parcela a fost stearsa');
    }
    public function print_parcele (Request $request)
    {
        $parcele=$request->session()->get('parcele');    
        return \PDF::loadView('parcele.print', array('parcele'=>$parcele))->download('parcele.pdf');
    }

    public function export_parcele ()
    {
        $parcele=Parcela::all();
        Excel::create('parcele', function($excel) use($parcele) {
            $excel->sheet('Sheet 1', function($sheet) use($parcele) {
            $sheet->fromModel($parcele);
            });
        })->download('xlsx');
    }
}
