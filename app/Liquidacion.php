<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Liquidacion extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    
    public function historia_laborales()
    {
    	return $this->belongsToMany( 'App\HistoriaLaboral');
    }
}
