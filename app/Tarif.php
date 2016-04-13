<?php

namespace gestiune_cimitire;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tarif extends Model
{
    //
     use SoftDeletes;
    protected $table= 'tarife';
    protected $dates= ['deleted_at'];
    protected $fillable = array('an', 'redeventa','intretinere');

     public static function boot(){
        parent::boot();
        self::deleting(function($tarif) {
            foreach ($tarif->rate()->get() as $rata) {
                $rata->delete();
            }
        });
        self::restoring(function($tarif) {
            foreach ($tarif->rate()->get() as $rata) {
                $rata->restore();
            }
        });

    }

    public function rate(){
    	return $this->hasMany('gestiune_cimitire\Rata');
    }
    public function plati(){
    	return $this->hasManyThrough('gestiune_cimitire\Rata','gestiune_cimitire\Plata');
   	}
   	public function concesiuni(){
   		return $this->hasMany('gestiune_cimitire\Concesiune');
   	}
     public function scopeFiltreaza($query , $params){
        if ( isset($params['an']) && trim($params['an']) !=='' ) {
            $query->where('an', 'LIKE', trim($params['an'] . '%'));
        }
        return $query;
    }

}
