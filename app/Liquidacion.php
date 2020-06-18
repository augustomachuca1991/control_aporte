<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\softDeletes;

class Liquidacion extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    
    public function historia_laborales()
    {
    	return $this->belongsToMany( 'App\HistoriaLaboral');
    }
}
