<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Liquidacion extends Model
{
    public function historia_laborales()
    {
    	return $this->belongsToMany( 'App\HistoriaLaboral');
    }
}
