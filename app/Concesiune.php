<?php

namespace gestiune_cimitire;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Concesiune extends Model
{
    //
   use SoftDeletes;
    protected $table= 'concesiuni';
    protected $dates= ['deleted_at'];
    protected $fillable = array('numar','durata','activa','id_tip');

     public static function boot(){
        parent::boot();
        self::deleting(function($concesiune) {
            foreach ($concesiune->rate()->get() as $rata) {
                $rata->delete();
            }
        });
        self::restoring(function($concesiune) {
            foreach ($concesiune->rate()->get() as $rata) {
                $rata->restore();
            }
        });

    }


  public function persoane(){
    	return $this->belongsToMany('gestiune_cimitire\Persoana','concesiune_persoana')->withTimestamps();
   }

   public function loc(){
   		return $this->belongsTo('gestiune_cimitire\Loc');
   }
   public function tip(){
    return $this->belongsTo('gestiune_cimitire\Tip');
   }
   public function rate(){
    return $this->hasMany('gestiune_cimitire\Rata');
   }

   public function plati(){
    return $this->hasManyThrough('gestiune_cimitire\Rata','gestiune_cimitire\Plata');
   }

   public function tarif(){
    return $this->belongsTo('gestiune_cimitire\Tarif');
   }
   
}
