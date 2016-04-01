<?php

namespace gestiune_cimitire\Http\Controllers;

use Illuminate\Http\Request;

use gestiune_cimitire\Http\Requests;
use gestiune_cimitire\Cimitir;
use gestiune_cimitire\Parcela;
use gestiune_cimitire\Loc;

class AppController extends Controller
{
    //
     public function getParcele($id=1) {
        $cimitir=Cimitir::findOrFail($id);
        $parcele=$cimitir->parcele->all();
        return $parcele;
    }
    public function getLocuri($id=1) {
        $parcela=Parcela::findOrFail($id);
        $locuri=$parcela->locuri->all();
        return $locuri;
    }
}
