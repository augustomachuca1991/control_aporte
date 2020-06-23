<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\softDeletes;

class LiquidacionDetalle extends Model
{
    //
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    /**
     * relacion uno a mucho con tabla liquidacions.
     *
     * @var array
     */
    public function liquidacion()
    {
        return $this->belongsTo('App\Liquidacion');
    }

    /**
     * relacion uno a mucho con tabla concepto_liquidacions.
     *
     * @var array
     */
    public function concepto()
    {
        return $this->belongsTo('App\ConceptoLiquidacion');
    }
}
