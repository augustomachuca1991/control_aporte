<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Dpto extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];


    public function subtipos(){

        return $this->belongsToMany( 'App\SubtipoCodigo' ,'configuracions' ,'dpto_id' , 'subtipo_id');
    }

    public function tipocodigos(){

        return $this->belongsToMany( 'App\TipoCodigo' ,'configuracions' ,'dpto_id' , 'tipocodigo_id');
    }
}



