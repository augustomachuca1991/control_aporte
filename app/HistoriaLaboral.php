<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HistoriaLaboral extends Model
{
    public function liquidaciones()
    {
    	return $this->belongsToMany('App\Liquidacion');
    }
}
