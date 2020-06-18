<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = [
        'cod_rol', 'rol'
    ];

    public function users(){

        return $this->belongsToMany('App\User');
    }

    protected $dates = ['deleted_at', 'created_at', 'updated_at'];
}
