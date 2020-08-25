<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Estado extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    public function liquidaciones()
    {
    	return $this->belongsToMany('App\Liquidacion','historia_liquidacion','cod_estado','estado_id');
    }

    public function organismo()
    {
        return $this->belongsTo('App\Organismo' ,'organismo_id' , 'cod_organismo');
    }
}
