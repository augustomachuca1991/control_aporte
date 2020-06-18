<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Organismo extends Model
{
    public function Jurisdiccion()
    {
        return $this->belongsTo('App\Jurisdiccion');
    }
}
