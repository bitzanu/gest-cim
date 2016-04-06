<?php

namespace gestiune_cimitire;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Plata extends Model
{
    //
    use SoftDeletes;
    protected $table= 'plati';
    protected $dates= ['deleted_at'];
    protected $fillable = array('numar', 'data','suma','rata_id');
    public function rata(){
    	return $this->belongsTo('gestiune_cimitire\Rata');
    }
    
}
