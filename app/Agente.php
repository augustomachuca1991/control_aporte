<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Agente extends Model
{
    use SoftDeletes; 

    protected $dates = ['deleted_at']; 
}
