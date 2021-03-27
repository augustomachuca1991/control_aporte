<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    public function index()
    {
        return view('users.index');
    }

    public function locker()
    {
        return view('users.lockscreen');
    }



    public function getUsers(){

        return User::with('roles')->paginate(9);
    }
}
