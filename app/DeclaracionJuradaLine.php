<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\softDeletes;

class DeclaracionJuradaLine extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $fillable = ['declaracionjurada_id', 'data'];
    protected $table = 'declaracion_jurada_lines';
}
