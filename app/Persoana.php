<?php

namespace gestiune_cimitire;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Persoana extends Model
{
    //
     use SoftDeletes;
    protected $table= 'persoane';
    protected $dates= ['deleted_at'];
    protected $fillable = array('nume', 'prenume' ,'adresa' , 'CNP');


    public function concesiuni(){
    	return $this->belongsToMany('gestiune_cimitire\Concesiune')->withTimestamps();
    }
}
