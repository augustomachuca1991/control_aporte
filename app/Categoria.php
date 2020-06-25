<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use \Illuminate\Database\Eloquent\SoftDeletes;
//use Iatstuti\Database\Support\CascadeSoftDeletes;


class Categoria extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at']; 

    protected $fillable = ['cod_categoria', 'categoria'];

    public function Clases()
    {
    	return $this->hasMany('App\Clase');
    }

    public function jurisdicciones(){
        return $this->belongsToMany('App\Jurisdiccion', 'categoria_jurisdiccion');
    }
}
