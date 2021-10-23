<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Periodo extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'cod_periodo',
        'periodo',
        'mes',
        'anio',
    ];

    protected $primaryKey = "cod_periodo";

    //relashionships

    public function liquidaciones()
    {
        return $this->belongsToMany('App\Liquidacion', 'liquidacion_organismo', 'periodo_id', 'liquidacion_id');
    }

    public function organismos()
    {
        return $this->belongsToMany('App\Organismo', 'liquidacion_organismo', 'periodo_id', 'organismo_id');
    }

    public function tipoLiquidaciones()
    {
        return $this->belongsToMany('App\TipoLiquidacion', 'liquidacion_organismo', 'periodo_id', 'tipo_id');
    }

    public function liquidacionOrganismo()
    {
        return $this->hasMany('App\LiquidacionOrganismo', 'periodo_id', 'cod_periodo')->with(['organismo', 'liquidacion', 'tipoLiquidacion']);
    }



    //buscador

    public function scopeFiltroPeriodo($query, $search)
    {
        if (!empty($search)) {
            $query->where('cod_periodo', 'LIKE', "%" . $search . "%")
                ->orWhere('periodo', 'LIKE', "%" . $search . "%")
                ->orWhere('mes', 'LIKE', "%" . $search . "%")
                ->orWhere('anio', 'LIKE', "%" . $search . "%");
        }
    }
}
