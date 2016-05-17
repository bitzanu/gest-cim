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
    protected $fillable = array('numar','durata','activa','id_tip','id_loc','id_tarif','motiv_sfarsit');

     

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
   public function getRestDePlataAttribute() {
      $restDePlata=0;
      $rate=$this->rate()->get();
      foreach ($rate as $rata){
        $restDePlata+=$rata->tarif->intretinere + $rata->tarif->redeventa - $rata->platit;
      }
      return $restDePlata;

   }
    public function scopeFiltreaza($query , $params){
        if ( isset($params['numar']) && trim($params['numar']) !=='' ) {
            $query->where('numar', 'LIKE', trim($params['numar']) . '%');
        }

        if ( isset($params['activa']) && trim($params['activa']) !=='') {
            $query->where('activa', '=', 1);
        }
        if ( isset($params['tip'] ) && trim($params['tip']) !=='') {
            $query->where('tip_id', '=', $params['tip']);
        }

        return $query;
    }
   
}
