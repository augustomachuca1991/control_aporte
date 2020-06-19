<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\softDeletes;

class Categoria extends Model
{
    //
    use SoftDeletes;

    protected $dates = ['deleted_at']; 

    protected $fillable = ['cod_categoria', 'categoria'];

    public function clases()
    {
    	return $this->hasMany('App\Clase');
    }
}
