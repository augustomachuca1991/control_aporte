<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class HistoriaLiquidacion extends Model
{
    use SoftDeletes;
   
    protected $dates = ['deleted_at'];
    protected $table = 'historia_liquidacion';
    protected $fillable = ['estado_id','funcion_id' , 'h_laboral_id', 'liquidacion_id'];

    public function estado()
    {
        return $this->belongsTo('App\Estado');
    }

    public function funcion()
    {
        return $this->belongsTo('App\Funcion');
    }

    
}
