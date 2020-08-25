<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DeclaracionJurada extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $fillable = ['user_id', 'organismo_id', 'secuencia'];

    public function ddjj_lines()
    {
        return $this->hasMany('App\DeclaracionJuradaLine','declaracionjurada_id','id');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function organismo()
    {
        return $this->belongsTo('App\Organismo')->with('jurisdiccion');
    }
}
