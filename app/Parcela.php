<?php
 
namespace gestiune_cimitire;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Parcela extends Model
{
     use SoftDeletes;    
    protected $touches = ['cimitir'];
    protected $table= 'parcele';
    protected $dates= ['deleted_at'];
    protected $fillable = array('numar' , 'cimitir_id');
    
    public function cimitir(){
    	return $this->belongsTo('gestiune_cimitire\Cimitir');
    }

    public function locuri(){
    	return $this->hasMany('gestiune_cimitire\Loc');
    }
    public function concesiuni(){
        return $this->hasManyThrough('gestiune_cimitire\Concesiune','gestiune_cimitire\Loc');
    }
    public function scopeFiltreaza($query , $params){
        if ( isset($params['numar']) && trim($params['numar']) !=='' ) {
            $query->where('numar', 'LIKE', trim($params['numar']) . '%');
        }

         if ( isset($params['cimitir'] ) && trim($params['cimitir']) !=='') {
            $query->where('cimitir_id', '=', $params['cimitir']);
        }

        return $query;
    }
}
