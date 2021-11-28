<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use SoftDeletes;
    use Notifiable;
    use HasRoles;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'tefelono'
    ];

    protected $dates = ['deleted_at', 'created_at', 'updated_at'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // public function roles(){

    //     return $this->belongsToMany( 'App\Role');
    // }

    public function declaracionesJuradas()
    {
        return $this->hasMany('App\DeclaracionJurada');
    }


    public function conceptos()
    {

        return $this->belongsToMany('App\ConceptoLiquidacion', 'configuracions', 'user_id', 'concepto_id');
    }


    public function adminlte_image()
    {
        //return 'https://picsum.photos/300/300';
        return 'https://ui-avatars.com/api/?name=' . urlencode($this->name) . '&color=7F9CF5&background=EBF4FF';
    }


    public function adminlte_desc()
    {
        return $this->roles->first()->name;
    }

    public function adminlte_profile_url()
    {
        return 'profile';
    }

    public function scopeFilterRole($query, $filter)
    {

        if (!empty($filter)) {
            $query->whereHas('roles', function ($roles) use ($filter) {
                $roles->where('role_id', $filter);
            });
        }
    }
}
