<?php

namespace gestiune_cimitire\Http\Controllers;

use Illuminate\Http\Request;

use gestiune_cimitire\Http\Requests;

class DashBoardController extends Controller
{
    //
    public function index()
{
    $dg = new \C_DataGrid('SELECT * FROM cimitire', 'nume', 'cimitire');
    $dg->enable_edit('FORM', 'CRUD');
    $dg->enable_autowidth(true)->enable_autoheight(true);
    $dg->set_theme('cobalt-flat');
    $dg->set_grid_property(array('cmTemplate'=>array('title'=>false)));
    $dg->display(false);

    $grid = $dg -> get_display(true); 

    return view('dashboard', ['grid' => $grid]);
}
}
