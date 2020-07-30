<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\softDeletes;

class PuestoLaboral extends Model
{
    use SoftDeletes;

    protected $table = 'agente_organismo';
    protected $dates = ['deleted_at'];

    public function clases(){

        return $this->belongsToMany( 'App\Clase', 'historia_laborals','puesto_id','clase_id');
    }

    public function agente()
    {
        return $this->belongsTo('App\Agente');
    }

    public function organismo()
    {
        return $this->belongsTo('App\Organismo')->with('Jurisdiccion');
    }

}
