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
    	return $this->belongsToMany('gestiune_cimitire\Concesiune','concesiune_persoana')->withTimestamps();
    }
    public function scopeFiltreaza($query , $params){
        if ( isset($params['nume']) && trim($params['nume']) !=='' ) {
            $query->where('nume', 'LIKE', trim($params['nume']) . '%');
        }
        if ( isset($params['prenume']) && trim($params['prenume']) !=='' ) {
            $query->where('prenume', 'LIKE', trim($params['prenume']) . '%');
        }
        if ( isset($params['CNP']) && trim($params['CNP']) !=='' ) {
            $query->where('CNP', 'LIKE', trim($params['CNP']) . '%');
        }
        

        return $query;
    }
}
