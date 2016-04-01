<?php

namespace gestiune_cimitire;
use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Database\Eloquent\Model;

class Rata extends Model
{
    //
    protected $table= 'rate';
    protected $fillable = array('concesiune_id','tarif_id');
     public static function boot(){
        parent::boot();
        self::deleting(function($rata) {
            foreach ($rata->plati()->get() as $plata) {
                $plata->delete();
            }
        });
        self::restoring(function($rata) {
            foreach ($rata->plati()->get() as $plata) {
                $plata->restore();
            }
        });

    }

    public function concesiune(){
    	return $this->belongsTo('gestiune_cimitire\Concesiune');
    }
     public function tarif(){
    	return $this->belongsTo('gestiune_cimitire\Tarif');
    }
    public function plati(){
    	return $this->hasMany('gestiune_cimitire\Plata');
    }
}
