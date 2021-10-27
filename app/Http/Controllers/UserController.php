<?php

namespace App\Http\Controllers;

use App\Jobs\ResetPasswordJob;
use App\Notifications\ResetPasswordNotification;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Support\Facades\Hash;


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



    public function getUsers()
    {

        return User::withTrashed()->with('roles')->paginate($this->perPage);
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:50',
            'email' => 'required|email|unique:users,email',
            'roles_id' => 'required',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make('ips2020.'),
        ]);

        $user->roles()->attach($request->roles_id);

        if ($request->send) {
            $delay = now()->addSeconds(5);
            ResetPasswordJob::dispatch($user)->delay($delay);
        }

        return $this->show($user->id);
    }


    public function desbloquear($id)
    {

        $user = User::withTrashed()->with('roles')->where('id', $id)->first();
        $user->restore();
        return $user;
    }


    public function destroy($id)
    {

        $user = User::find($id);
        $name_user = $user->name;
        $user->delete();
        return $name_user;
    }


    public function search($search)
    {
        return User::withTrashed()
            ->with('roles')
            ->where('name', 'LIKE', "%" . $search . "%")
            ->paginate($this->perPage);
    }


    public function show($id)
    {
        return User::with('roles')->where('id', $id)->first();
    }
}
