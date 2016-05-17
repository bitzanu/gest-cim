<?php

namespace gestiune_cimitire;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Requests; 
class Cimitir extends Model
{
    use SoftDeletes;
    protected $table= 'cimitire';
    protected $dates= ['deleted_at'];
    protected $fillable = array('nume', 'adresa');

    
    public function parcele(){
    	return $this->hasMany('gestiune_cimitire\Parcela');
    }
    

  
    public function locuri(){
    	return $this->hasManyThrough('gestiune_cimitire\Loc' , 'gestiune_cimitire\Parcela');
    }

    
    
    public function scopeFiltreaza($query , $params){
        if ( isset($params['nume']) && trim($params['nume']) !=='' ) {
            $query->where('nume', 'LIKE', trim($params['nume']) . '%');
        }
        

        return $query;
    }
}
