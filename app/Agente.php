<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Agente extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $fillable = [
        'cuil',
        'nombre',
        'fecha_nac',
        'sexo',
    ];


    public function organismos()
    {

        return $this->belongsToMany('App\Organismo', 'agente_organismo', 'agente_id', 'organismo_id')->as('puesto_laboral')->withPivot('cod_laboral', 'fecha_ingreso', 'fecha_egreso');
    }

    public function puestolaborales()
    {
        return $this->hasMany('App\PuestoLaboral')->with('organismo');
    }

    public function scopeAutocompleteAgente($query, $search)
    {
        if (!empty($search)) {
            $query->where('cuil', 'LIKE', "%" . $search . "%")->orWhere('nombre', 'LIKE', "%" . $search . "%");
        }
    }
}
