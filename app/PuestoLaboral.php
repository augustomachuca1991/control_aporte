<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PuestoLaboral extends Model
{
    use SoftDeletes;

    protected $table = 'agente_organismo';
    protected $dates = ['deleted_at'];
    protected $fillable = [
        'cod_laboral',
        'organismo_id',
        'agente_id',
        'fecha_ingreso',
        'fecha_egreso'
    ];
    protected $primaryKey = 'cod_laboral';

    public function clases(){

        return $this->belongsToMany( 'App\Clase', 'historia_laborals','puesto_id','clase_id')->with('Categoria')->withPivot('id');
    }

    public function agente()
    {
        return $this->belongsTo('App\Agente');
    }

    public function organismo()
    {
        return $this->belongsTo('App\Organismo')->with('Jurisdiccion');
    }

    public function historialaborales()
    {
        return $this->hasMany('App\HistoriaLaboral' ,'puesto_id');
    }

}
