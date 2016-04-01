<?php

namespace gestiune_cimitire;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Loc extends Model
{
    //
     use SoftDeletes;
    protected $touches = ['parcela'];
    protected $table= 'locuri';
    protected $dates= ['deleted_at'];
    protected $fillable = array('numar', 'lungime','latime','numar_locuri','constructie', 'parcela_id');
    public static function boot(){
        parent::boot();
        self::deleting(function($loc) {
            foreach ($loc->concesiuni()->get() as $concesiune) {
                $concesiune->delete();
            }
        });
        self::restoring(function($loc) {
            foreach ($loc->concesiuni()->get() as $concesiune) {
                $concesiune->restore();
            }
        });

    }
    public function parcela(){
    	return $this->belongsTo('gestiune_cimitire\Parcela');
    }
    public function concesiuni(){
    	return $this->hasMany('gestiune_cimitire\Concesiune');
    }
    public function rate() {
        return $this->hasManyThrough('gestiune_cimitire\Concesiune','gestiune_cimitire\Rata');
    }
    public function plati() {
        return $this->hasManyThrough('gestiune_cimitire\Concesiune','gestiune_cimitire\Rata','gestiune_cimitire\Plata');
    }
    public function scopeFiltreaza($query , $params){
        if ( isset($params['numar']) && trim($params['numar']) !=='' ) {
            $query->where('locuri.numar', 'LIKE', trim($params['numar']) . '%');
        }

        if ( isset($params['parcela']) && trim($params['parcela']) !=='') {
            $query->where('locuri.parcela_id', '=', $params['parcela']);
        }

        return $query;
    }
}
