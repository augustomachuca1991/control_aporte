<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\softDeletes;

class HistoriaLaboral extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    
    public function liquidaciones()
    {
    	return $this->belongsToMany('App\Liquidacion');
    }
}
