<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Clase extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = ['cod_clase' ,'categoria_id', 'clase'];

    public function categoria()
    {
    	return $this->belongsTo('App\Categoria');
    }

    public function puestolaborales(){

        return $this->belongsToMany( 'App\PuestoLaboral', 'historia_laborals', 'id', 'clase_id');
    }
}
