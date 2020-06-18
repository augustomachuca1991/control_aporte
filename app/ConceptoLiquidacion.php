<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ConceptoLiquidacion extends Model
{
    //
    use SoftDeletes;

    protected $dates = ['deleted_at'];
}
