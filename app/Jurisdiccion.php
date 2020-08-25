<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Jurisdiccion extends Model
{

    use SoftDeletes;

    protected $table = 'jurisdiccions';
    protected $fillable = ['cod_jurisdiccion', 'origen_id', 'jurisdiccion'];
    protected $dates = ['deleted_at'];

    public function origen()
    {
        return $this->belongsTo('App\Origen' ,'origen_id' , 'cod_origen');
    }


    public function organismos()
    {
        return $this->hasMany('App\Organismo','jurisdiccion_id','id');
    }

    public function categorias(){
        return $this->belongsToMany('App\Categoria');
    }

}
