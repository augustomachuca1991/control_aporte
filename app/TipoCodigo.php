<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TipoCodigo extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    public function subtipos()
    {
        return $this->hasMany('App\SubtipoCodigo', 'tipocodigo_id', 'id');
    }
}
