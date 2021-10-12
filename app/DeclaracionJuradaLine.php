<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DeclaracionJuradaLine extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $table = 'declaracion_jurada_lines';
    protected $fillable = [
    	'declaracionjurada_id', 
    	'nombre',
    	'cuil' ,
    	'fecha_nac',
    	'sexo',
    	'puesto_laboral',
    	'cargo',
    	'fecha_ingreso',
        'cod_categoria',
        'categoria',
    	'cod_clase',
    	'clase',
    	'cod_estado',
    	'estado',
    	'cod_jurisdiccion',
    	'jurisdiccion',
    	'cod_organismo',
    	'organismo',
        'detalle'
    ];
    
}


