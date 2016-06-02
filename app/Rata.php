<?php

namespace gestiune_cimitire;
use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Database\Eloquent\Model;

class Rata extends Model
{
    //
    use SoftDeletes;
    protected $table= 'rate';
    protected $fillable = array('concesiune_id','tarif_id');
    protected $dates= ['deleted_at'];
    

    public function concesiune(){
    	return $this->belongsTo('gestiune_cimitire\Concesiune');
    }
     public function tarif(){
    	return $this->belongsTo('gestiune_cimitire\Tarif');
    }
    public function plati(){
    	return $this->hasMany('gestiune_cimitire\Plata');
    }
    public function getPlatitAttribute(){
        $totalPlatit=0;
        $plati=$this->plati()->get();
        foreach($plati as $plata){
            $totalPlatit+=$plata->suma;
        }
        return $totalPlatit;
    }
    public function getDePlataAttribute(){
        $dePlata=($this->tarif->intretinere+$this->tarif->redeventa)-($this->tarif->intretinere+$this->tarif->redeventa)*$this->concesiune->tip->reducere/100;
        return $dePlata;

    }
}
