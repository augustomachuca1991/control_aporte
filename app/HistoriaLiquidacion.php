<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HistoriaLiquidacion extends Model
{
    //
    use SoftDeletes;

    protected $dates = ['deleted_at'];
}
