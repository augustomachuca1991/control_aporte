<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jurisdiccion extends Model
{
    
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    
    public function origen()
    {
        return $this->belongsTo('App\Origen');
    }


    public function organismos()
    {
        return $this->hasMany('App\Organismo');
    }

}
