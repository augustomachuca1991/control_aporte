<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Dpto extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];


    public function conceptos(){

        return $this->belongsToMany( 'App\ConceptoLiquidacion' ,'configuracions' ,'dpto_id' , 'concepto_id');
    }
}



