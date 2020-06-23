<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\softDeletes;

class TipoCodigo extends Model
{
    //
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    public function subtipocodigo()
    {
        return $this->hasMany('App\SubtipoCodigo');
    }
}
