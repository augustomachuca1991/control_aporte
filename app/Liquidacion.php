<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Liquidacion extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $fillable = [
        'declaracion_id',
        'bruto',
        'basico',
        'aporte_personal',
        'haberes_con_aporte',
        'bonificable',
        'no_bonificable',
        'no_remunerativo',
        'familiar',
        'descuento',
    ];
    
    /**
     * relacion mucho a mucho con tabla historia_laborals.
     *
     * @var array
     */
    public function historia_laborales()
    {
    	return $this->belongsToMany( 'App\HistoriaLaboral','historia_liquidacion', 'h_laboral_id', 'liquidacion_id')->with(['puesto','clase','historialiquidaciones']);
    }

    /**
     * relacion mucho a mucho con tabla estados.
     *
     * @var array
     */
    public function estados()
    {
        return $this->belongsToMany( 'App\Estado','historia_liquidacion','estado_id','liquidacion_id')->with('organismo');
    }

    /**
     * relacion mucho a mucho con tabla funciones.
     *
     * @var array
     */
    public function funciones()
    {
        return $this->belongsToMany('App\Funcion','historia_liquidacion','id','liquidacion_id')->with('organismo');
    }

    /**
     * relacion mucho a mucho con tabla organismos.
     *
     * @var array
     */
    public function organismos()
    {
    	return $this->belongsToMany('App\Organismo')->with('jurisdiccion');
    }

    /**
     * relacion mucho a mucho con tabla periodos.
     *
     * @var array
     */
    public function periodos()
    {
    	return $this->belongsToMany('App\Periodo','liquidacion_organismo','id', 'liquidacion_id');
    }

    /**
     * relacion mucho a mucho con tabla tipo_liquidacions.
     *
     * @var array
     */
    public function tipoLiquidaciones()
    {
    	return $this->belongsToMany('App\TipoLiquidacion','liquidacion_organismo','id', 'liquidacion_id');
    }

    /**
     * relacion uno a mucho con tabla liquidacionDetalles.
     *
     * @var array
     */
    public function detalles()
    {
        return $this->hasMany('App\LiquidacionDetalle')->with('concepto');
    }

    /**
     * relacion mucho a mucho con tabla conceptos.
     *
     * @var array
     */
    public function conceptos()
    {
        return $this->belongsToMany('App\ConceptoLiquidacion','liquidacion_detalles','liquidacion_id', 'concepto_id');
    }


    public function liquidacionOrganismo()
    {
        return $this->hasMany('App\LiquidacionOrganismo')->with(['organismo','periodo','tipoliquidacion']);
    }



    public function scopeBuscarLiquidacion($query, $search)
    {
        # code...
        if(!empty($search)){
            $query->where('liquidacion_id' ,'LIKE' ,"%".$search."%");
            // ->orWhere('periodo' ,'LIKE' ,"%".$search."%")
            // ->orWhere('mes' ,'LIKE' ,"%".$search."%")
            // ->orWhere('anio' ,'LIKE' ,"%".$search."%");

        }
    }

    public function scopeName($query, $name){

      if($name)
        return $query->where(\DB::raw("CONCAT(apellido,'',name)"),'LIKE', '%'.str_replace(' ','',$name).'%');
    }



}
    

