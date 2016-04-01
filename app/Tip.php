<?php

namespace gestiune_cimitire;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use gestiune_cimitire\Concesiune;


class Tip extends Model
{
    //
     use SoftDeletes;
    protected $touches = ['concesiune'];
    protected $table= 'tipuri';
    protected $dates= ['deleted_at'];
    protected $fillable = array('nume', 'reducere');

    public function concesiuni(){
    	return $this->hasMany('gestiune_cimitire\Concesiune');
    }

}
