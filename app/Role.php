<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model
{
    use SoftDeletes;
    
    protected $fillable = [
        'name', 'guard_name'
    ];
    protected $dates = ['deleted_at', 'created_at', 'updated_at'];

    public function permissions() 
    { 
        return $this->belongsToMany( 
            config('permission.models.permission'), 
            config('permission.table_names.role_has_permissions'), 
            'role_id', 
            'permission_id' 
        ); 
    } 

    public function users(){

        return $this->belongsToMany('App\User')->withTimestamps();
    }

}
