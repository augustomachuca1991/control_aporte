<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Organismo extends Model
{
    
	use SoftDeletes;

    protected $dates = ['deleted_at'];
    
    public function Jurisdiccion()
    {
        return $this->belongsTo('App\Jurisdiccion');
    }
}
