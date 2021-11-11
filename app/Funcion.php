<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Funcion extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $fillable = ['organismo_id','funcion'];

    public function liquidaciones()
    {
    	return $this->belongsToMany('App\Liquidacion');
    }

    public function organismo()
    {
        return $this->belongsTo('App\Organismo' ,'organismo_id' , 'cod_organismo');
    }
}
