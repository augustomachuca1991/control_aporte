<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HistoriaLaboral extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    
    public function liquidaciones()
    {
    	return $this->belongsToMany('App\Liquidacion');
    }
}
