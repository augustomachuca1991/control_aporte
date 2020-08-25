<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Agente extends Model
{
    use SoftDeletes; 

    protected $dates = ['deleted_at'];

    public function organismos(){

        return $this->belongsToMany( 'App\Organismo');
    }

    public function puestolaborales()
    {
        return $this->hasMany('App\PuestoLaborales');
    } 
} 
