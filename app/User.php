<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use SoftDeletes;

    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
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

    public function roles(){

        return $this->belongsToMany( 'App\Role');
    }

    public function declaracionesJuradas()
    {
        return $this->hasMany('App\DeclaracionJurada');
    }


    public function adminlte_image()
    {
        return 'https://picsum.photos/300/300';
    }


    public function adminlte_desc()
    {
        return 'administrador';
    }

    public function adminlte_profile_url()
    {
        return 'profile/username';
    }
}
