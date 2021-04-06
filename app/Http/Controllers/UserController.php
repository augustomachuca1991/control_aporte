<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    
    public $perPage = 9;

    public function index()
    {
        return view('users.index');
    }

    public function locker()
    {
        return view('users.lockscreen');
    }



    public function getUsers(){

        return User::withTrashed()->with('roles')->paginate($this->perPage);
    }


    public function desbloquear($id){

        $user = User::withTrashed()->with('roles')->where('id' ,$id)->first();
        $user->restore();
        return $user;
    }


    public function destroy($id){

        $user = User::find($id);
        $name_user = $user->name;
        $user->delete();
        return $name_user;
    }


    public function search($search)
    {
            return User::withTrashed()
            ->with('roles')
            ->where('name' ,'LIKE' ,"%".$search."%")
            ->paginate($this->perPage);
        

    }
}
