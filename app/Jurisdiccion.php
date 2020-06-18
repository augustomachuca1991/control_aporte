<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\softDeletes;

class Jurisdiccion extends Model
{
    //
    //use SoftDeletes;

    //protected $dates = ['deleted_at'];
    protected $fillable = [
        'id', 'cod_jurisdiccion','origen_id' ,'jurisdiccion' ,'created_at', 'updated_at'
    ];

    public function origen(){
        return $this->belongsTo(Origen::class);
    }
}
