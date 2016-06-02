<?php

namespace gestiune_cimitire\Http\Controllers;

use Illuminate\Http\Request;
use gestiune_cimitire\Http\Requests;
use gestiune_cimitire\Http\Requests\ConcesiuneFormRequest;
use gestiune_cimitire\Concesiune;
use gestiune_cimitire\Tarif;
use gestiune_cimitire\Persoana;
use gestiune_cimitire\Tip;
use gestiune_cimitire\Cimitir;
use gestiune_cimitire\Loc;
use gestiune_cimitire\Parcela;
use gestiune_cimitire\Rata;
use Session;
use Excel;
class ConcesiuniController extends Controller
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
        $cimitire=Cimitir::all();
        $tipuri=[''=>'-Alege Tip-']+Tip::lists('nume', 'id')->all();
        $concesiuni=Concesiune::paginate(10);
        Session::put('concesiuni',$concesiuni);
        return view('concesiuni.index')->with('concesiuni' , $concesiuni)->with('cimitire',$cimitire)->with('tipuri',$tipuri);
    }
    public function index_filtrat(Request $request) 
    {
        $cimitire=Cimitir::all();
        $tipuri=[''=>'-Alege Tip-']+Tip::lists('nume', 'id')->all();
        if ($request->has('an')) {
        // are an    
        if ($request->has('cimitir')) 
        {  
            if ($request->get('parcela') == '0') {
                //un cimitir toate parcelele
                  $concesiuni=Concesiune::filtreaza($request->all())
                  ->whereIn('tarif_id',Tarif::where('an','=',$request->get('an'))->lists('id'))
                  ->whereIn('loc_id',Cimitir::findOrFail($request->get('cimitir'))->locuri->lists('id'))
                  ->paginate(10);
            } else {
                    if ($request->get('loc') == '0') {
                    //o parcela si toate locurile
                            $concesiuni=Concesiune::filtreaza($request->all())
                             ->whereIn('tarif_id',Tarif::where('an','=',$request->get('an'))->lists('id'))
                             ->whereIn('loc_id',Parcela::findOrFail($request->get('parcela'))->locuri->lists('id'))
                            ->paginate(10);
                    } else {
                        // un loc
                            $concesiuni=Concesiune::filtreaza($request->all())
                            ->whereIn('tarif_id',Tarif::where('an','=',$request->get('an'))->lists('id'))
                            ->where('loc_id','=',$request->get('loc'))
                            ->paginate(10);
                            }
                    }
        //nu are cimitir 
        } else {

                $concesiuni=Concesiune::filtreaza($request->all())
                ->whereIn('tarif_id',Tarif::where('an','=',$request->get('an'))->lists('id'))
                ->paginate(10);
                }
        //nu are an
        } else {

             if ($request->has('cimitir')) 
            { 
            //nu are an dar are cimitir 
            if ($request->get('parcela') == '0') {
                //toate parcelele
                  $concesiuni=Concesiune::filtreaza($request->all())
                  ->whereIn('loc_id',Cimitir::findOrFail($request->get('cimitir'))->locuri->lists('id'))
                  ->paginate(10);
            } else {
                    if ($request->get('loc') == '0') {
                    // o parcela toate locurile 
                            $concesiuni=Concesiune::filtreaza($request->all())
                            ->whereIn('loc_id',Parcela::findOrFail($request->get('parcela'))->locuri->lists('id'))
                            ->paginate(10);
                    } else {
                        //un singur loc
                           $concesiuni=Concesiune::filtreaza($request->all())
                            ->where('loc_id','=',$request->get('loc'))
                            ->paginate(10);
                            }
                    }
        //nu are cimitir si nici an
        } else {

                $concesiuni=Concesiune::filtreaza($request->all())->paginate(10);
                }

        }

        //Session::put('concesiuni',$concesiuni);  
        //Session::put('persoane',$concesiuni->persoane);       
        return view('concesiuni.index')->with('concesiuni' , $concesiuni)->with('cimitire',$cimitire)->with('tipuri',$tipuri);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($persoanaid)
    {
        //
        $tarife=Tarif::lists('an','id');
        $tipuri=Tip::lists('nume','id');
        $cimitire=Cimitir::all();
        $persoane=Persoana::orderBy('nume')->orderBy('prenume')->selectRaw("concat(nume, ' ' ,prenume, ' ',CNP) as nume_prenume, id")->lists('nume_prenume','id');

        return view('concesiuni.create')->with('tarife', $tarife)->with('persoane',$persoane)->with('tipuri',$tipuri)->with('cimitire',$cimitire);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ConcesiuneFormRequest $request)
    {
        //

        $tarif=Tarif::findOrFail($request->get('tarif'));
        $tip=Tip::findOrFail($request->get('tip'));
        $loc=Loc::findOrFail($request->get('loc'));
        $concesiune=new Concesiune(array(
            'numar'=>$request->get('numar'),
            'durata'=>$request->get('durata')
            ));
        $concesiune->tarif()->associate($tarif);
        $concesiune->tip()->associate($tip);
        $concesiune->loc()->associate($loc);
        $concesiune->save();
        $concesiune->persoane()->attach($request->get('persoane'));
        
        return \Redirect::route('concesiuni.index')->with('message', 'concesiunea a fost creeata' );
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
        $concesiune=Concesiune::findOrFail($id);
        $restDePlata=$concesiune->rest_de_plata;
               
        $rate=$concesiune->rate()->paginate(10);
        return view('concesiuni.show')->with(array('concesiune'=>$concesiune,'rate'=>$rate,'restDePlata'=>$restDePlata));
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
        $concesiune=Concesiune::findOrFail($id);
        $tipuri=Tip::lists('nume','id');
         $cimitire=Cimitir::all();
        $persoane=Persoana::orderBy('nume')->orderBy('prenume')->selectRaw("concat(nume, ' ' ,prenume, ' ',CNP) as nume_prenume, id")->lists('nume_prenume','id');
        return view('concesiuni.edit')->with('concesiune', $concesiune)->with('persoane',$persoane)->with('tipuri',$tipuri)->with('cimitire',$cimitire);
    }
    public function dezactivare($id)
    {
        //
        $concesiune=Concesiune::findOrFail($id);
        $ani=Tarif::where('an','>=',$concesiune->tarif->an)
                    ->where('an','<',$concesiune->tarif->an+$concesiune->durata)
                    ->lists('an','id');
        return view('concesiuni.dezactivare')->with('concesiune', $concesiune)->with('ani',$ani);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ConcesiuneFormRequest $request, $id)
    {
        //
        $concesiune=Concesiune::findOrFail($id);
        $concesiune->persoane()->sync($request->get('persoane'));
        $durata_veche=$concesiune->durata;
        $concesiune->loc()->associate($request->get('loc'));
        $concesiune->tip()->associate($request->get('tip'));
        $concesiune->update([
            'numar' => $request->get('numar'),
            'durata' => $request->get('durata'),
            ]);
        if ($concesiune->durata < $durata_veche) {
            foreach ($concesiune->rate as $rata) {
                if ($rata->tarif->an >=  $concesiune->tarif->an + $concesiune->durata) 
                {   
                    $rata->delete();
                }
            }
        }
        if ($concesiune->durata > $durata_veche){
            $tarife=Tarif::where('an','<',$concesiune->tarif->an + $concesiune->durata)
                            ->where('an','>=',$concesiune->tarif->an + $durata_veche)->get();
            foreach ($tarife as $tarif ) {
                $rata=new Rata();
                $rata->tarif()->associate($tarif);
                $rata->concesiune()->associate($concesiune);
                $rata->save();
            }
        };
        return \Redirect::route('concesiuni.index')->with('message' , 'concesiunea  a fost modificata');
    }
    public function update_dezactivare(Request $request, $id)
    {
        //
         $concesiune=Concesiune::findOrFail($id);
         $concesiune->update([
            'durata'=>1+Tarif::find($request->get('an'))->an-$concesiune->tarif->an,
            'motiv_sfarsit'=>$request->get('motiv'),
            'activa'=>false
            ]);
         foreach ($concesiune->rate as $rata) {
            if ($rata->tarif->an >=  $concesiune->tarif->an + $concesiune->durata) 
            {
              
                $rata->delete();
            }
         };
         return \Redirect::route('concesiuni.index')->with('message' , 'concesiunea  a fost dezactivata');
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
     public function print_concesiuni (Request $request)
    {
        $concesiuni=Concesiune::all();
        return \PDF::loadView('concesiuni.print', array('concesiuni'=>$concesiuni))->download('concesiuni.pdf');
    }
    
    public function export_concesiuni ()
    {
        $concesiuni=Concesiune::all();
        Excel::create('concesiune', function($excel) use($concesiuni) {
            $excel->sheet('Sheet 1', function($sheet) use($concesiuni) {
            $sheet->fromModel($concesiuni);
            });
        })->download('xlsx');
    }
}
