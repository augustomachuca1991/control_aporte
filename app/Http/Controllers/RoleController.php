<?php

namespace App\Http\Controllers;

//use App\Role;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function getRoles()
    {
        return Role::all();
    }
}
