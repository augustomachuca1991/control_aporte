<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Origen extends Model
{
    public function Jurisdicciones()
    {
        return $this->hasMany('App\Jurisdiccion');
    }

    public function jurisdiccionOrganismo()
    {
        return $this->hasManyThrough(
            'App\Organismo',
            'App\Jurisdiccion',
            'origen_id', // Foreign key on cars table...
            'jurisdiccion_id', // Foreign key on owners table...
            'cod_origen', // Local key on mechanics table...
            'cod_jurisdiccion' // Local key on cars table...
        );
    }
}
